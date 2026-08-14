<?php

#region USE

use Illuminate\Support\Facades\Route;
use Narsil\Cms\Form\Http\Controllers\FormSearchController;

#endregion

Route::middleware([
    'auth',
    'verified',
])->group(
    function ()
    {
        #region RESOURCES

        Route::prefix('forms')->name('forms.')->group(function ()
        {
            Route::get('/search', FormSearchController::class)
                ->name('search');
        });

        #endregion
    }
);
