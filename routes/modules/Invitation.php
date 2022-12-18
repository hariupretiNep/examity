<?php

use App\Http\Controllers\Modules\InvitationController;
use Illuminate\Support\Facades\Route;

Route::prefix('/invitation')->group(function () {
    Route::get('/{code}',[InvitationController::class,'accessInvitation'])->name("invitationRequest");
});