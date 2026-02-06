<?php

#region USE

use Illuminate\Support\Facades\Route;
use Narsil\Cms\Form\Http\Controllers\GraphQL\GraphiQLController;

#endregion

Route::get('/graphiql', GraphiQLController::class)
    ->name('graphiql');
