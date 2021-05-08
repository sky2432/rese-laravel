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

// お気に入り
Route::get('users/{user_id}/favorites', [FavoriteController::class, 'show'])->name('favorites.show');
Route::put('shops/{shop_id}/favorite', [FavoriteController::class, 'update'])->name('favorite.update');
Route::delete('shops/{shop_id}/favorite', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

// 予約
Route::get('users/{user_id}/reservations', [FavoriteController::class, 'show'])->name('reservations.user');
Route::get('shops/{shop_id}/reservations', [ReservationController::class, 'shop'])->name('reservations.shop');
Route::apiResource('shops/{shop_id}/reservation', ReservationController::class)->except(['index', 'show']);

// 店舗
Route::apiResource('shops', ShopController::class)->except('destroy');

// 評価
Route::apiResource('shops/{shop_id}/evaluation', EvaluationController::class)->except(['index', 'show']);

// メール
Route::post('mail', [MailController::class, 'mail'])->name('mail');

// 認証
Route::post('users/login', [AuthController::class, 'login'])->name('login');
Route::post('users/login/confirm', [AuthController::class, 'confirm'])->name('login.confirm');
Route::post('users/logout', [AuthController::class, 'logout'])->name('logout');
