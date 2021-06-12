<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['auth:user,owner,admin'])->group(function () {
    // オーナー
    Route::get('owners/{owner_id}/shop', [OwnerController::class, 'showOwnerShop'])->name('owners.shop');
    Route::put('owners/{owner_id}/password', [OwnerController::class, 'updatePassword'])->name('owners.password.update');
    Route::post('owners/confirm', [OwnerController::class, 'confirm'])->name('owners.confirm');
    Route::apiResource('owners', OwnerController::class);

    //管理者
    Route::put('admins/{admin_id}/password', [AdminController::class, 'updatePassword'])->name('admins.password.update');
    Route::post('admins/confirm', [AdminController::class, 'confirm'])->name('admins.confirm');
    Route::apiResource('admins', AdminController::class);


    // お気に入り
    Route::get('users/{user_id}/favorites', [FavoriteController::class, 'show'])->name('favorites.show');
    Route::apiResource('shops/favorite', FavoriteController::class)->only('store', 'destroy');

    // 予約
    Route::get('users/{user_id}/reservations', [ReservationController::class, 'showUserReservations'])->name('reservations.user');
    Route::get('shops/{shop_id}/reservations', [ReservationController::class, 'showShopReservations'])->name('reservations.shop');
    Route::apiResource('shops/reservation', ReservationController::class)->except(['index', 'show']);

    // 店舗
    Route::put('shops/{shop_id}/image', [ShopController::class, 'updateImage'])->name('shops.image.update');
    // Route::put('shops/{shop_id}/address', [ShopController::class, 'updateAddress'])->name('shops.address');
    Route::get('shops/{shop_id}/image', [ShopController::class, 'downloadImage'])->name('shops.image.download');
    Route::apiResource('shops', ShopController::class);

    // 評価
    Route::apiResource('shops/evaluation', EvaluationController::class)->except(['index', 'show']);

    // メール
    Route::post('mail', [MailController::class, 'sendForAll'])->name('mail.all');
    Route::post('users/mail', [MailController::class, 'sendForUsers'])->name('mail.users');
    Route::post('owners/mail', [MailController::class, 'sendForOwners'])->name('mail.owners');
});

// ユーザー
Route::put('users/{user_id}/password', [UserController::class, 'updatePassword'])->name('users.password.update');
Route::post('users/confirm', [UserController::class, 'confirm'])->name('users.confirm');
Route::apiResource('users', UserController::class);

// 認証
Route::post('login/{type}', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
