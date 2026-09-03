<?php

declare(strict_types=1);

#region USE

use Illuminate\Support\Facades\Route;
use Narsil\Cms\Form\Http\Controllers\FormSubmitController;

#endregion

Route::post('/forms/{form}/submit', FormSubmitController::class);
