<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        try {
            if ($request->hasFile('my_file')) {
                $file = $request->file('my_file');
                $name = $file->getClientOriginalName();
                $image_name = $request->file('my_file')->getRealPath();

                Cloudder::upload($image_name, null);
                list($width, $height) = getimagesize($image_name);

                $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height]);
                $file->move(public_path("uploads"), $name);

                return response()->json([
                    'url' => $image_url
                ], 200);
            } else {
                $message = $this->getMessage('FILE_NOT_PROVIDED');
                return response()->json(['message' => $message], 400);
            }
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }
}
