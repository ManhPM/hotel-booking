<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CouponController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\PaymentMethodController;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UploadController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VnpayController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::middleware(['language', 'auth:api'])->group(function () {
    Route::prefix('v1')->group(function () {

        Route::get('roles/{id}', [RoleController::class, 'show'])->middleware('check.role.exist');
        Route::get('roles', [RoleController::class, 'index'])->middleware('permission:show-role');
        Route::post('roles', [RoleController::class, 'store'])->middleware('permission:create-role');
        Route::put('roles/{id}', [RoleController::class, 'update'])->middleware('permission:update-role', 'check.role.exist');
        Route::delete('roles/{id}', [RoleController::class, 'destroy'])->middleware('permission:delete-role', 'check.role.exist');

        Route::get('users/{id}', [UserController::class, 'show'])->middleware('check.user.exist');
        Route::get('users', [UserController::class, 'index'])->middleware('permission:show-user');
        Route::post('users', [UserController::class, 'store'])->middleware('permission:create-user');
        Route::put('users/{id}', [UserController::class, 'update'])->middleware('permission:update-user', 'check.user.exist');
        Route::delete('users/{id}', [UserController::class, 'destroy'])->middleware('permission:delete-user', 'check.user.exist');

        Route::get('categories/detail/{id}', [CategoryController::class, 'show'])->middleware('check.category.exist');
        Route::post('categories', [CategoryController::class, 'store'])->middleware('permission:create-category');
        Route::put('categories/{id}', [CategoryController::class, 'update'])->middleware('permission:update-category', 'check.category.exist');
        Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->middleware('permission:delete-category', 'check.category.exist');

        // Route::post('rooms', [RoomController::class, 'store'])->middleware('permission:create-room');
        // Route::put('rooms/{id}', [RoomController::class, 'update'])->middleware('permission:update-room', 'check.room.exist');
        // Route::delete('rooms/{id}', [RoomController::class, 'destroy'])->middleware('permission:delete-room', 'check.room.exist');

        Route::post('rooms', [RoomController::class, 'store']);
        Route::put('rooms/{id}', [RoomController::class, 'update'])->middleware('check.room.exist');
        Route::delete('rooms/{id}', [RoomController::class, 'destroy'])->middleware('check.room.exist');

        Route::get('coupons/{id}', [CouponController::class, 'show'])->middleware('check.coupon.exist');
        Route::post('coupons', [CouponController::class, 'store'])->middleware('permission:create-coupon');
        Route::put('coupons/{id}', [CouponController::class, 'update'])->middleware('permission:update-coupon', 'check.coupon.exist');
        Route::delete('coupons/{id}', [CouponController::class, 'destroy'])->middleware('permission:delete-coupon', 'check.coupon.exist');

        Route::get('payment_methods/{id}', [PaymentMethodController::class, 'show'])->middleware('check.payment.method.exist');
        Route::post('payment_methods', [PaymentMethodController::class, 'store']);
        Route::put('payment_methods/{id}', [PaymentMethodController::class, 'update'])->middleware('check.payment.method.exist');
        Route::delete('payment_methods/{id}', [PaymentMethodController::class, 'destroy'])->middleware('check.payment.method.exist');

        Route::get('bookings/confirm/{id}', [BookingController::class, 'confirmBooking'])->middleware('permission:confirm-order', 'check.booking.exist');
        Route::get('bookings/cancel/{id}', [BookingController::class, 'cancelBooking'])->middleware('permission:cancel-order', 'check.booking.exist');
        Route::get('bookings', [BookingController::class, 'index'])->middleware('permission:show-order');
        Route::get('bookings/user', [BookingController::class, 'getAllBookingUser']);
        Route::get('bookings/detail/{id}', [BookingController::class, 'getDetailBooking'])->middleware('permission:show-order-detail', 'check.booking.exist');

        // Route::post('vnpay/create_payment_url', [VnpayController::class, 'createPaymentUrl']);

        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('profile', [AuthController::class, 'profile']);
        Route::put('profile', [AuthController::class, 'update']);
    });
});

Route::prefix('v1')->group(function () {
    // Route::get('coupons', [CouponController::class, 'index']);
    // Route::get('rooms', [RoomController::class, 'index']);
    // Route::get('payment_methods', [PaymentMethodController::class, 'index']);
    // Route::get('rooms/{id}', [RoomController::class, 'show'])->middleware('check.room.exist');
    // Route::post('login', [AuthController::class, 'login']);
    // Route::post('register', [AuthController::class, 'register']);
    // Route::get('refresh_token', [AuthController::class, 'refreshToken']);

    // Route::post('upload', [UploadController::class, 'upload']);
    // Route::get('change_language', [Controller::class, 'changeLanguage']);
    // Route::get('test', [Controller::class, 'test']);

    // Route::get('vnpay/vnpay_return', [VnpayController::class, 'vnpayReturn']);

    // Route::post('forgot_password', [AuthController::class, 'forgotPassword']);
    // Route::post('reset_password', [AuthController::class, 'resetPassword']);
});

Route::middleware('language')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::get('categories/{id}', [CategoryController::class, 'getRoomsByCategoryId'])->middleware('check.category.exist');
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('coupons', [CouponController::class, 'index']);
        Route::get('rooms', [RoomController::class, 'index']);
        Route::get('payment_methods', [PaymentMethodController::class, 'index']);
        Route::get('rooms/{id}', [RoomController::class, 'show'])->middleware('check.room.exist');
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::get('refresh_token', [AuthController::class, 'refreshToken']);

        Route::post('upload', [UploadController::class, 'upload']);
        Route::get('change_language', [Controller::class, 'changeLanguage']);
        // Route::get('test', [Controller::class, 'test']);

        Route::get('vnpay/vnpay_return', [VnpayController::class, 'vnpayReturn']);

        Route::post('forgot_password', [AuthController::class, 'forgotPassword']);
        Route::post('reset_password', [AuthController::class, 'resetPassword']);
    });
});
