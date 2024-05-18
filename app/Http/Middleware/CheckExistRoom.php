<?php

namespace App\Http\Middleware;

use App\Models\Room;
use App\Services\MessageService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckExistRoom
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }
    public function handle(Request $request, Closure $next)
    {
        try {
            $item = Room::find($request->route('id'));
            if (!$item) {
                $message = $this->messageService->getMessage('ROOM_NOTFOUND');
                return response()->json(['message' => $message], 404);
            }
            return $next($request);
        } catch (\Throwable $th) {
            $message = $this->messageService->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }
}
