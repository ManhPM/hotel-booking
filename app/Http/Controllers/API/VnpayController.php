<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Http\Controllers\Controller;

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

class VnpayController extends Controller
{
    public function createPaymentUrl(Request $request)
    {
        try {
            $booking_id = $request->booking_id;
            $booking = Booking::where('id', $request->booking_id)->where('user_id', auth()->user()->id)->first();

            if (!$booking) {
                $message = $this->getMessage('INVOICE_NOTFOUND');
                return response()->json(['message' => $message], 404);
            }

            if ($booking->payment_status == 'paid' || $booking->payment_method_id == 2) {
                $message = $this->getMessage('PAYMENT_ERROR3');
                return response()->json(['message' => $message], 400);
            }

            $vnp_Url = env('VNP_URL');
            $vnp_Returnurl = env('VNP_RETURN_URL');
            $vnp_TmnCode = env('VNP_TMNCODE');
            $vnp_HashSecret = env('VNP_HASH_SECRET');

            $locale = $request->language ?? 'vn';
            $currCode = 'VND';
            $bankCode = 'NCB';

            $vnp_TxnRef = $booking_id;
            $vnp_OrderInfo = 'Thanh toán cho mã đơn hàng:' . $booking_id;
            $vnp_OrderType = 'other';
            $vnp_Amount = $booking->total * 100;
            $vnp_Locale = $locale;
            $vnp_BankCode = $bankCode;
            $vnp_IpAddr = $request->ip();

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";

            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }

            return response()->json(['url' => $vnp_Url]);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    public function vnpayReturn(Request $request)
    {
        try {
            $vnp_Params = $request->query();

            unset($vnp_Params['vnp_SecureHash']);
            unset($vnp_Params['vnp_SecureHashType']);

            $booking_id = $vnp_Params['vnp_TxnRef'];

            ksort($vnp_Params);

            $booking = Booking::find($booking_id);

            if (!$booking) {
                $message = $this->getMessage('INVOICE_NOTFOUND');
                return response()->json(['message' => $message], 404);
            }

            $booking->payment_status = 'paid';
            $booking->save();

            $message = $this->getMessage('TRANSACTION_SUCCESS');
            return response()->json(['message' => $message], 200);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }
}
