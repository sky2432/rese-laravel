<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// ユーザー
Route::apiResource('users', UserController::class)->except(['index']);
Route::put('users/{user_id}/password', [UserController::class, 'updatePassword'])->name('users.updatePassword');
Route::post('users/confirm', [UserController::class, 'confirm'])->name('users.confirm');

// オーナー
Route::apiResource('owners', OwnerController::class);
Route::get('owners/{owner_id}/shop', [OwnerController::class, 'showOwnerShop'])->name('owners.shop');

// お気に入り
Route::get('users/{user_id}/favorites', [FavoriteController::class, 'show'])->name('favorites.show');
Route::apiResource('shops/favorite', FavoriteController::class)->only('store', 'destroy');

// 予約
Route::get('users/{user_id}/reservations', [ReservationController::class, 'showUserReservation'])->name('reservations.user');
Route::get('shops/{shop_id}/reservations', [ReservationController::class, 'showShopReservation'])->name('reservations.shop');
Route::apiResource('shops/reservation', ReservationController::class)->except(['index', 'show']);

// 店舗
Route::apiResource('shops', ShopController::class)->except('destroy');

// 評価
Route::apiResource('shops/evaluation', EvaluationController::class)->except(['index', 'show']);

// メール
Route::post('users/mail', [MailController::class, 'mail'])->name('mail');

// 認証
Route::post('users/login', [AuthController::class, 'userLogin'])->name('users.login');
Route::post('owners/login', [AuthController::class, 'ownerLogin'])->name('owner.login');
Route::post('admins/login', [AuthController::class, 'adminLogin'])->name('admin.login');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');


