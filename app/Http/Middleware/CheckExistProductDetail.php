<?php

namespace App\Http\Middleware;

use App\Models\ProductDetail;
use App\Services\MessageService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckExistProductDetail
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }
    public function handle(Request $request, Closure $next)
    {
        try {
            $item = ProductDetail::where('product_id', $request->product_id)->where('size', $request->product_size)->first();
            if (!$item) {
                $message = $this->messageService->getMessage('PRODUCT_NOTFOUND');
                return response()->json(['message' => $message], 404);
            }
            return $next($request);
        } catch (\Throwable $th) {
            $message = $this->messageService->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }
}
