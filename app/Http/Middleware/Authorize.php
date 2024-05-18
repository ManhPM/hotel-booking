<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\RoleHasPermission;
use App\Services\MessageService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Authorize
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function handle(Request $request, Closure $next, $permission)
    {
        try {
            $user = auth()->user();

            $rolesId = $user->roles->pluck('id')->toArray();

            $permissions = RoleHasPermission::where('role_id', $rolesId)->get();

            $permissionsName = [];
            foreach ($permissions as $item) {
                $tempPermission = Permission::where('id', $item->permission_id)->first();
                if ($tempPermission) {
                    $permissionsName[] = $tempPermission->name;
                }
            }

            if (!in_array($permission, $permissionsName)) {
                $message = $this->messageService->getMessage('FORBIDDEN');
                return response()->json([
                    'message' => $message
                ], Response::HTTP_FORBIDDEN);
            }

            return $next($request);
        } catch (\Throwable $th) {
            $message = $this->messageService->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }
}
