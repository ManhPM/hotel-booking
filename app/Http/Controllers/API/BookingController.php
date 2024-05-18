<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Http\Resources\ResponseResource;
use App\Models\Booking;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function index()
    {
        try {
            return new ResponseResource(Booking::latest('id')->paginate(5));
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    public function getAllBookingUser()
    {
        try {
            return new ResponseResource(Booking::latest('id')->where('user_id', auth()->user()->id)->paginate(5));
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDetailBooking($id)
    {
        try {
            $booking = $this->booking->with(['payments', 'payment_method', 'coupon'])->find($id);
            return $this->sentSuccessResponse($booking, '', Response::HTTP_OK);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message . $th], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmBooking($id)
    {
        try {
            $booking = $this->booking->find($id);
            if (!$booking) {
                $message = $this->getMessage('INVOICE_NOTFOUND');
                return response()->json(['message' => $message], 404);
            }
            if ($booking->status != 'pending') {
                $message = $this->getMessage('CONFIRM_ERROR');
                return response()->json(['message' => $message], 400);
            }

            $booking->status = 'confirmed';
            $booking->save();

            $message = $this->getMessage('CONFIRM_SUCCESS');
            return response()->json(['message' => $message], 200);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    public function cancelBooking($id)
    {
        try {
            $booking = $this->booking->with('products')->find($id);
            if (!$booking) {
                $message = $this->getMessage('INVOICE_NOTFOUND');
                return response()->json(['message' => $message], 404);
            }
            if ($booking->status != 'pending') {
                $message = $this->getMessage('CANCEL_INVOICE_ERROR');
                return response()->json(['message' => $message], 400);
            }
            $booking->status = 'canceled';
            $booking->save();

            $message = $this->getMessage('CANCEL_SUCCESS');
            return response()->json(['message' => $message], 200);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
