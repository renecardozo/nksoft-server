<?php
Route::middleware(['role:Docente'])->group(function(){
    Route::get('users', [UserController::class, 'index'])->name('users.index');
});
