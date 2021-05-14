<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// ユーザー
Route::apiResource('users', UserController::class)->except(['index']);
Route::put('users/{user_id}/password', [UserController::class, 'updatePassword'])->name('users.updatePassword');

// お気に入り
Route::get('users/{user_id}/favorites', [FavoriteController::class, 'show'])->name('favorites.show');
Route::apiResource('shops/favorite', FavoriteController::class)->only('store', 'destroy');

// 予約
Route::get('users/{user_id}/reservations', [ReservationController::class, 'user'])->name('reservations.user');
Route::get('shops/{shop_id}/reservations', [ReservationController::class, 'shop'])->name('reservations.shop');
Route::apiResource('shops/reservation', ReservationController::class)->except(['index', 'show']);

// 店舗
Route::apiResource('shops', ShopController::class)->except('destroy');

// 評価
Route::apiResource('shops/evaluation', EvaluationController::class)->except(['index', 'show']);

// メール
Route::post('users/mail', [MailController::class, 'mail'])->name('mail');

// 認証
Route::post('users/login', [AuthController::class, 'login'])->name('login');
Route::post('users/login/confirm', [AuthController::class, 'confirm'])->name('login.confirm');
Route::post('users/logout', [AuthController::class, 'logout'])->name('logout');
