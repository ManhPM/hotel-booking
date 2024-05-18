<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{

    protected $user;
    protected $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                return response()->json(['message' => 'Thông tin đăng nhập chưa chính xác'], Response::HTTP_BAD_REQUEST);
            }

            $request = Request::create('oauth/token', 'POST', [
                'grant_type' => 'password',
                'client_id' => env("CLIENT_ID"),
                'client_secret' => env("CLIENT_SECRET"),
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ]);

            $result = app()->handle($request);
            $response = json_decode($result->getContent(), true);
            $message = $this->getMessage('LOGIN_SUCCESS');
            return response()->json(['message' => $message, 'access_token' => $response['access_token'], 'refresh_token' => $response['refresh_token'], 'expires_in' => $response['expires_in']], Response::HTTP_OK);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message . $th], 500);
        }
    }

    public function refreshToken(Request $request)
    {
        try {
            $refreshToken = $request->header('refresh_token');

            if (!$refreshToken) {
                return response()->json(['message' => 'Không có refresh token'], Response::HTTP_NOT_FOUND);
            }

            $request = Request::create('oauth/token', 'POST', [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
                'client_id' => env("CLIENT_ID"),
                'client_secret' => env("CLIENT_SECRET"),
                'scope' => '',
            ]);

            $result = app()->handle($request);
            $response = json_decode($result->getContent(), true);
            $message = $this->getMessage('REFRESH_TOKEN_SUCCESS');
            return response()->json(['message' => $message, 'access_token' => $response['access_token'], 'refresh_token' => $response['refresh_token'], 'expires_in' => $response['expires_in']], Response::HTTP_OK);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $dataCreate = $request->all();
            $dataCreate['password'] = Hash::make($request->password);
            $user = $this->user->create($dataCreate);
            $user->roles()->attach(['5']);
            $message = $this->getMessage('REGISTER_SUCCESS');
            return $this->sentSuccessResponse('', $message, Response::HTTP_OK);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    public function update(UpdateProfileRequest $request)
    {
        try {
            $user = User::findOrFail(auth()->user()->id);
            $dataUpdate = $request->except('password');
            if ($request->password) {
                $dataUpdate['password'] = Hash::make($request->password);
            }
            $user->update($dataUpdate);
            $message = $this->getMessage('UPDATE_SUCCESS');
            return $this->sentSuccessResponse('', $message, Response::HTTP_OK);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            $user = auth()->user();
            $user->tokens->each(function ($token, $key) {
                $token->delete();
            });
            $message = $this->getMessage('LOGOUT_SUCCESS');
            return $this->sentSuccessResponse('', $message, Response::HTTP_OK);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    public function profile(Request $request)
    {
        try {
            $profile = auth()->user();
            return $this->sentSuccessResponse($profile, '', Response::HTTP_OK);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    public function forgotPassword(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email|exists:users,email']);

            $currentTimeSub15Minutes = Carbon::now()->subMinutes(15);
            $reset = DB::table('password_resets')
                ->where('email', $request->email)
                ->where('created_at', '>', $currentTimeSub15Minutes)
                ->first();

            if ($reset) {
                $message = $this->getMessage('SMS_SEND_ERROR');
                return response()->json(['message' => $message], Response::HTTP_BAD_REQUEST);
            }

            $token = mt_rand(100000, 999999);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            $htmlContent = $this->createHtmlContent($token);

            Mail::html($htmlContent, function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Lấy lại mật khẩu');
            });
            $message = $this->getMessage('SMS_SEND_SUCCESS');
            return response()->json(['message' => $message], 200);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|min:6',
            ]);
            if ($request->password != $request->password_confirmation) {
                $message = $this->getMessage('INPUT_PASSWORD_ERROR3');
                return $this->sentSuccessResponse('', $message, Response::HTTP_BAD_REQUEST);
            }

            $currentTimeSub15Minutes = Carbon::now()->subMinutes(15);

            $reset = DB::table('password_resets')
                ->where('token', $request->token)
                ->where('email', $request->email)
                ->where('created_at', '>', $currentTimeSub15Minutes)
                ->first();

            if (!$reset) {
                $message = $this->getMessage('VERIFY_ERROR');
                return response()->json(['message' => $message], Response::HTTP_BAD_REQUEST);
            }

            $user = User::where('email', $request->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();

            DB::table('password_resets')->where('email', $request->email)->delete();

            $message = $this->getMessage('FORGOT_PASSWORD_SUCCESS');
            return response()->json(['message' => $message], 200);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'old_password' => 'required|min:6',
                'new_password' => 'required|min:6',
                'repeat_password' => 'required|min:6',
            ]);

            $currentUser = auth()->user();

            if (!Hash::check($request->old_password, $currentUser->password)) {
                return $this->sentSuccessResponse('', 'Mật khẩu cũ không chính xác', Response::HTTP_BAD_REQUEST);
            }
            if ($request->old_password != $request->new_password) {
                return $this->sentSuccessResponse('', 'Mật khẩu lặp lại không khớp', Response::HTTP_BAD_REQUEST);
            }
            if ($request->old_password == $request->new_password) {
                return $this->sentSuccessResponse('', 'Mật khẩu mới không được trùng với mật khẩu cũ', Response::HTTP_BAD_REQUEST);
            }

            $user = User::where('email', $request->email)->first();
            $user->password = Hash::make($request->new_password);
            $user->save();

            $message = $this->getMessage('CHANGE_PASSWORD_SUCCESS');
            return response()->json(['message' => $message]);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    public function createHtmlContent($token)
    {
        return '<!DOCTYPE html>
      <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
      <head>
          <meta charset="utf-8"> <!-- utf-8 works for most cases -->
          <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn"t be necessary -->
          <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
          <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
          <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->
          <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link href="http://fonts.googleapis.com/css?family=Work+Sans:200,300,400,500,600,700" rel="stylesheet">

          <!-- CSS Reset : BEGIN -->
          <style>

              html,
      body {
          margin: 0 auto !important;
          padding: 0 !important;
          height: 100% !important;
          width: 100% !important;
          background: #f1f1f1;
      }

      * {
          -ms-text-size-adjust: 100%;
          -webkit-text-size-adjust: 100%;
      }

      div[style*="margin: 16px 0"] {
          margin: 0 !important;
      }

      table {
          border-spacing: 0 !important;
          border-collapse: collapse !important;
          table-layout: fixed !important;
          margin: 0 auto !important;
      }

      img {
          -ms-interpolation-mode:bicubic;
      }

      a {
          text-decoration: none;
      }

      *[x-apple-data-detectors],  /* iOS */
      .unstyle-auto-detected-links *,
      .aBn {
          border-bottom: 0 !important;
          cursor: default !important;
          color: inherit !important;
          text-decoration: none !important;
          font-size: inherit !important;
          font-family: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
      }
      .a6S {
          display: none !important;
          opacity: 0.01 !important;
      }
      .im {
          color: inherit !important;
      }
      img.g-img + div {
          display: none !important;
      }
      @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
          u ~ div .email-container {
              min-width: 320px !important;
          }
      }
      @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
          u ~ div .email-container {
              min-width: 375px !important;
          }
      }
      @media only screen and (min-device-width: 414px) {
          u ~ div .email-container {
              min-width: 414px !important;
          }
      }
          </style>
          <style>
      .primary{
          background: #448ef6;
      }
      .bg_white{
          background: #ffffff;
      }
      .bg_light{
          background: #fafafa;
      }
      .bg_black{
          background: #000000;
      }
      .bg_dark{
          background: rgba(0,0,0,.8);
      }
      .email-section{
          padding:2.5em;
      }
      .btn{
          padding: 5px 15px;
          display: inline-block;
      }
      .btn.btn-primary{
          border-radius: 30px;
          background: #448ef6;
          color: #ffffff;
      }
      .btn.btn-white{
          border-radius: 30px;
          background: #ffffff;
          color: #000000;
      }
      .btn.btn-white-outline{
          border-radius: 30px;
          background: transparent;
          border: 1px solid #fff;
          color: #fff;
      }

      h1,h2,h3,h4,h5,h6{
          font-family: "Work Sans", sans-serif;
          color: #000000;
          margin-top: 0;
          font-weight: 400;
      }

      body{
          font-family: "Work Sans", sans-serif;
          font-weight: 400;
          font-size: 15px;
          line-height: 1.8;
          color: rgba(0,0,0,.4);
      }

      a{
          color: #448ef6;
      }

      .logo h1{
          margin: 0;
      }
      .logo h1 a{
          color: #000000;
          font-size: 20px;
          font-weight: 700;
          text-transform: uppercase;
          font-family: "Poppins", sans-serif;
      }

      .navigation{
          padding: 0;
      }
      .navigation li{
          list-style: none;
          display: inline-block;;
          margin-left: 5px;
          font-size: 13px;
          font-weight: 500;
      }
      .navigation li a{
          color: rgba(0,0,0,.4);
      }
      .hero{
          position: relative;
          z-index: 0;
      }

      .hero .overlay{
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          content: "";
          width: 100%;
          background: #000000;
          z-index: -1;
          opacity: .3;
      }

      .hero .text{
          color: rgba(255,255,255,.9);
      }
      .hero .text h2{
          color: #fff;
          font-size: 50px;
          margin-bottom: 0;
          font-weight: 300;
          line-height: 1;
      }
      .hero .text h2 span{
          font-weight: 600;
          color: #448ef6;
      }

      .heading-section h2{
          color: #000000;
          font-size: 28px;
          margin-top: 0;
          line-height: 1.4;
          font-weight: 400;
      }
      .heading-section .subheading{
          margin-bottom: 20px !important;
          display: inline-block;
          font-size: 13px;
          text-transform: uppercase;
          letter-spacing: 2px;
          color: rgba(0,0,0,.4);
          position: relative;
      }
      .heading-section .subheading::after{
          position: absolute;
          left: 0;
          right: 0;
          bottom: -10px;
          content: "";
          width: 100%;
          height: 2px;
          background: #448ef6;
          margin: 0 auto;
      }

      .heading-section-white{
          color: rgba(255,255,255,.8);
      }
      .heading-section-white h2{
          color: #ffffff;
      }
      .heading-section-white .subheading{
          margin-bottom: 0;
          display: inline-block;
          font-size: 13px;
          text-transform: uppercase;
          letter-spacing: 2px;
          color: rgba(255,255,255,.4);
      }
      .text-services .meta{
          text-transform: uppercase;
          font-size: 14px;
          margin-bottom: 0;
      }
      .footer{
          color: rgba(255,255,255,.5);

      }
      .footer .heading{
          color: #ffffff;
          font-size: 20px;
      }
      .footer ul{
          margin: 0;
          padding: 0;
      }
      .footer ul li{
          list-style: none;
          margin-bottom: 10px;
      }
      .footer ul li a{
          color: rgba(255,255,255,1);
      }
      @media screen and (max-width: 500px) {
      }
          </style>
      </head>

      <body width="100%" style="margin: 0; padding: 0 !important; background-color: #222222;">
          <center style="width: 100%; background-color: #f1f1f1;">
          <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
          </div>
          <div style="max-width: 600px; margin: 0 auto;" class="email-container">
              <!-- BEGIN BODY -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" width="100%" style="margin: auto;">
                <tr>
                <td valign="top" class="bg_white" style="padding: 1em 2.5em;">
                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                    </table>
                </td>
                </tr><!-- end tr -->
                <tr>
                <td valign="middle" class="hero bg_white" style="background-image: url(http://res.cloudinary.com/dpgjnngzt/image/upload/v1693155759/cc8qb9rmjoxgsl2wx7fe_r9nmrg.webp); background-size: cover; height: 400px;">
                    <div class="overlay"></div>
                </td>
                </tr><!-- end tr -->
                <tr>
                  <td class="bg_white email-section">
                      <div class="heading-section" style="text-align: center; padding: 0 30px;">
                        <h2>YOUR VERIFICATION CODE: <br>' . $token . '</h2>
                        <p style="font-size: 20px;">Thank you for using our service.</p>
                      </div>
                </td>
              </tr><!-- end: tr -->
            <!-- 1 Column Text + Button : END -->
            </table>
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" width="100%" style="margin: auto;">
                <tr>
                <td valign="middle" class="bg_black footer email-section">
                  <table>
                      <tr>
                      <td valign="top" width="33.333%" style="padding-top: 20px;">
                        <table role="presentation" cellspacing="0" cellpadding="0" width="100%">
                          <tr>
                            <td style="text-align: left; padding-left: 5px; padding-right: 5px;">
                                <h3 class="heading">Contact Info</h3>
                                <ul>
                                  <li><span class="text">Address: 123 Nguyen Van A Street,
                                  Ward 4, District 3,
                                  Ho Chi Minh City,
                                  Vietnam</span></li>
                                  <li><span class="text">Phone: +84 392 392 210</span></a></li>
                                  <li><span class="text">Email: footwearsupport@gmail.com</span></a></li>
                                        </ul>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr><!-- end: tr -->
              <tr>
                  <td valign="middle" class="bg_black footer email-section">
                      <table>
                      <tr>
                      <td valign="top" width="100%">
                        <table role="presentation" cellspacing="0" cellpadding="0" width="100%">
                          <tr>
                            <td style="text-align: left; padding-right: 10px;">
                                <p>&copy; 2024 Footwear. All Rights Reserved</p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                  </td>
              </tr>
            </table>
          </div>
        </center>
      </body>
      </html>';
    }


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
}
