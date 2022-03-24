<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MakeRequestController;
use App\Http\Controllers\ProcessRequestController;
use App\Http\Controllers\ViewRequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Authentication route
Route::prefix("auth")->name("auth.")->group(function () {
    Route::post('login', [AuthenticationController::class, 'login'])->name("login");
});

//authenticated routes

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function() {
    Route::post('logout', [AuthenticationController::class, 'logout'])->name("logout");
});

Route::middleware(['auth:sanctum','role:super_admin|create_request_admin|update_request_admin'])->prefix('v1')->group(function() {
    Route::get('view-pending-requests', [ViewRequestController::class, 'show'])->name("show");
});

Route::middleware(['auth:sanctum','role:create_request_admin'])->prefix('v1')->group(function() {
    Route::post('make_request', [MakeRequestController::class, 'make_request'])->name("make_request");
});

Route::middleware(['auth:sanctum','role:update_request_admin'])->prefix('v1')->group(function() {
    Route::post('approve_request', [ProcessRequestController::class, 'approve_request'])->name("approve_request");
    Route::post('decline_request', [ProcessRequestController::class, 'decline_request'])->name("decline_request");
});