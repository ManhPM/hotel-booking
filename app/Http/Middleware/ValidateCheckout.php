<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Coupon;
use App\Models\Order;
use App\Services\MessageService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ValidateCheckout
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }
    public function handle(Request $request, Closure $next)
    {
        try {
            $item = Order::where('status', 'pending')->first();
            if ($item) {
                $message = $this->messageService->getMessage('CHECKOUT_ERROR1');
                return response()->json(['message' => $message], 400);
            }
            if ($request->code) {
                $coupon =  Coupon::where('name', $request['code'])->first();
                if (!$coupon) {
                    $message = $this->messageService->getMessage('COUPON_NOT_FOUND');
                    return response()->json(['message' => $message], 404);
                }
            }
            return $next($request);
        } catch (\Throwable $th) {
            $message = $this->messageService->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }
}
