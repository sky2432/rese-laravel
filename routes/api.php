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
Route::apiResource('users', UserController::class)->except(['index', 'store']);
Route::post('users/registration', [UserController::class, 'register'])->name('users.register');
// お気に入り
Route::get('users/{user_id}/favorites', [FavoriteController::class, 'show'])->name('favorite.show');
Route::apiResource('shops/{shop_id}/favorite', FavoriteController::class)->only(['store', 'destroy']);

// 予約
Route::apiResource('reservations', ReservationController::class)->except(['index', 'destroy']);
Route::get('reservations/shops/{id}', [ReservationController::class, 'shop'])->name('reservations.shop');
Route::post('reservations/delete', [ReservationController::class, 'delete'])->name('reservations.delete');
// 店舗
Route::apiResource('shops', ShopController::class)->except('destroy');
// 評価
Route::apiResource('evaluations', EvaluationController::class)->except('index');
Route::post('evaluations/delete', [EvaluationController::class, 'delete'])->name('evaluations.delete');

// メール
Route::post('mail', [MailController::class, 'mail'])->name('mail');
// 認証
Route::post('users/login', [AuthController::class, 'login'])->name('login');
Route::post('users/login/confirm', [AuthController::class, 'confirm'])->name('login.confirm');
Route::post('users/logout', [AuthController::class, 'logout'])->name('logout');
