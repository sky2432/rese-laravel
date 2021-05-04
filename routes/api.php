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
Route::apiResource('users', UserController::class)->except(['index', 'destroy']);
Route::post('users/delete', [UserController::class, 'delete'])->name('users.delete');
// お気に入り
Route::apiResource('favorites', FavoriteController::class)->only(['show', 'store']);
Route::post('favorites/delete', [FavoriteController::class, 'delete'])->name('favorites.delete');
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
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('login/confirm', [AuthController::class, 'confirm'])->name('login.confirm');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
