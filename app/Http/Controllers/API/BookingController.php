<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Http\Resources\ResponseResource;
use App\Models\Booking;
use App\Models\Coupon;
use App\Models\Room;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $booking;
    protected $room;
    protected $coupon;

    public function __construct(Booking $booking, Room $room, Coupon $coupon)
    {
        $this->booking = $booking;
        $this->room = $room;
        $this->coupon = $coupon;
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

    public function createOfflineBooking(Request $request)
    {
        try {

            $dataCreate = $request->all();
            $checkInDate = new DateTime($dataCreate['check_in_date']);
            $checkOutDate = new DateTime($dataCreate['check_out_date']);
            $interval = $checkInDate->diff($checkOutDate);
            $days = $interval->days;
            if ($days < 0) {
                $message = $this->getMessage('INPUT_DATE_ERROR');
                return response()->json(['message' => $message], 200);
            }
            $dataCreate['user_id'] = auth()->user()->id;
            $dataCreate['type'] = 'offline';
            $dataCreate['status'] = 'confirmed';
            $dataCreate['payment_status'] = 'unpaid';
            $room = $this->room->findOrFail($request->room_id);
            $coupon = $this->coupon->findOrFail($request->coupon_id);
            $dataCreate['total'] = $days * $room->price * (100 - $coupon->value) / 100;

            $this->booking->create($dataCreate);

            $message = $this->getMessage('CREATE_SUCCESS');
            return response()->json(['message' => $message], 200);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message . $th], 500);
        }
    }

    public function createOnlineBooking(Request $request)
    {
        try {

            $dataCreate = $request->all();
            $checkInDate = new DateTime($dataCreate['check_in_date']);
            $checkOutDate = new DateTime($dataCreate['check_out_date']);
            $interval = $checkInDate->diff($checkOutDate);
            $days = $interval->days;
            if ($days < 0) {
                $message = $this->getMessage('INPUT_DATE_ERROR');
                return response()->json(['message' => $message], 200);
            }
            $dataCreate['user_id'] = auth()->user()->id;
            $dataCreate['type'] = 'online';
            $dataCreate['status'] = 'pending';
            $dataCreate['payment_status'] = 'unpaid';
            $room = $this->room->findOrFail($request->room_id);
            $coupon = $this->coupon->findOrFail($request->coupon_id);
            $dataCreate['total'] = $days * $room->price * (100 - $coupon->value) / 100;

            $this->booking->create($dataCreate);

            $message = $this->getMessage('CREATE_SUCCESS');
            return response()->json(['message' => $message], 200);
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

    public function checkIn($id)
    {
        try {
            $booking = $this->booking->find($id);
            if (!$booking) {
                $message = $this->getMessage('INVOICE_NOTFOUND');
                return response()->json(['message' => $message], 404);
            }
            if ($booking->status != 'confirmed') {
                $message = $this->getMessage('CHECK_IN_ERROR');
                return response()->json(['message' => $message], 400);
            }

            $booking->status = 'checked in';
            $booking->payment_status = 'paid';
            $room = $this->room->findOrFail($booking->room_id);
            $room->status = 'in use';
            $room->save();
            $booking->save();

            $message = $this->getMessage('CHECK_IN_SUCCESS');
            return response()->json(['message' => $message], 200);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    public function checkOut($id)
    {
        try {
            $booking = $this->booking->find($id);
            if (!$booking) {
                $message = $this->getMessage('INVOICE_NOTFOUND');
                return response()->json(['message' => $message], 404);
            }
            if ($booking->status != 'checked in') {
                $message = $this->getMessage('CHECK_OUT_ERROR');
                return response()->json(['message' => $message], 400);
            }

            $booking->status = 'checked out';
            $room = $this->room->findOrFail($booking->room_id);
            $room->status = 'empty';
            $room->save();
            $booking->save();

            $message = $this->getMessage('CHECK_OUT_SUCCESS');
            return response()->json(['message' => $message], 200);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    public function cancelBooking($id)
    {
        try {
            $booking = $this->booking->find($id);
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
