<?php

use App\Http\Controllers\Modules\InvitationController;
use Illuminate\Support\Facades\Route;

Route::prefix('/invitation')->group(function () {
    Route::get('/{code}',[InvitationController::class,'accessInvitation'])->name("invitationRequest");
    Route::post('/start-test',[InvitationController::class,'startInvitationTest'])->name("startInvitationTest");
    Route::post('/submit',[InvitationController::class,'submitInvitationTest'])->name("submitInvitationTest");
});