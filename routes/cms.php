<?php

#region USE

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Narsil\Cms\Form\Http\Controllers\Fieldsets\FieldsetCreateController;
use Narsil\Cms\Form\Http\Controllers\Fieldsets\FieldsetDestroyController;
use Narsil\Cms\Form\Http\Controllers\Fieldsets\FieldsetDestroyManyController;
use Narsil\Cms\Form\Http\Controllers\Fieldsets\FieldsetEditController;
use Narsil\Cms\Form\Http\Controllers\Fieldsets\FieldsetIndexController;
use Narsil\Cms\Form\Http\Controllers\Fieldsets\FieldsetReplicateController;
use Narsil\Cms\Form\Http\Controllers\Fieldsets\FieldsetReplicateManyController;
use Narsil\Cms\Form\Http\Controllers\Fieldsets\FieldsetStoreController;
use Narsil\Cms\Form\Http\Controllers\Fieldsets\FieldsetUpdateController;
use Narsil\Cms\Form\Http\Controllers\FormCreateController;
use Narsil\Cms\Form\Http\Controllers\FormDestroyController;
use Narsil\Cms\Form\Http\Controllers\FormDestroyManyController;
use Narsil\Cms\Form\Http\Controllers\FormEditController;
use Narsil\Cms\Form\Http\Controllers\FormIndexController;
use Narsil\Cms\Form\Http\Controllers\FormReplicateController;
use Narsil\Cms\Form\Http\Controllers\FormReplicateManyController;
use Narsil\Cms\Form\Http\Controllers\FormSearchController;
use Narsil\Cms\Form\Http\Controllers\FormStoreController;
use Narsil\Cms\Form\Http\Controllers\FormUpdateController;
use Narsil\Cms\Form\Http\Controllers\Inputs\InputCreateController;
use Narsil\Cms\Form\Http\Controllers\Inputs\InputDestroyController;
use Narsil\Cms\Form\Http\Controllers\Inputs\InputDestroyManyController;
use Narsil\Cms\Form\Http\Controllers\Inputs\InputEditController;
use Narsil\Cms\Form\Http\Controllers\Inputs\InputIndexController;
use Narsil\Cms\Form\Http\Controllers\Inputs\InputReplicateController;
use Narsil\Cms\Form\Http\Controllers\Inputs\InputReplicateManyController;
use Narsil\Cms\Form\Http\Controllers\Inputs\InputStoreController;
use Narsil\Cms\Form\Http\Controllers\Inputs\InputUpdateController;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\Input;

#endregion

Route::middleware([
    'auth',
    'verified',
])->group(
    function ()
    {
        #region RESOURCES

        Route::prefix(Str::slug(Fieldset::TABLE))->name(Str::slug(Fieldset::TABLE) . '.')->group(function ()
        {
            Route::get('/', FieldsetIndexController::class)
                ->name('index');
            Route::get('/create', FieldsetCreateController::class)
                ->name('create');
            Route::post('/', FieldsetStoreController::class)
                ->name('store');
            Route::get('/{fieldset}/edit', FieldsetEditController::class)
                ->name('edit');
            Route::patch('/{fieldset}', FieldsetUpdateController::class)
                ->name('update');
            Route::delete('/{fieldset}', FieldsetDestroyController::class)
                ->name('destroy');
            Route::delete('/', FieldsetDestroyManyController::class)
                ->name('destroy-many');
            Route::post('/{fieldset}/replicate', FieldsetReplicateController::class)
                ->name('replicate');
            Route::post('/replicate-many', FieldsetReplicateManyController::class)
                ->name('replicate-many');
        });

        Route::prefix(Str::slug(Form::TABLE))->name(Str::slug(Form::TABLE) . '.')->group(function ()
        {
            Route::get('/', FormIndexController::class)
                ->name('index');
            Route::get('/create', FormCreateController::class)
                ->name('create');
            Route::post('/', FormStoreController::class)
                ->name('store');
            Route::get('/{form}/edit', FormEditController::class)
                ->name('edit');
            Route::patch('/{form}', FormUpdateController::class)
                ->name('update');
            Route::delete('/{form}', FormDestroyController::class)
                ->name('destroy');
            Route::delete('/', FormDestroyManyController::class)
                ->name('destroy-many');
            Route::post('/{form}/replicate', FormReplicateController::class)
                ->name('replicate');
            Route::post('/replicate-many', FormReplicateManyController::class)
                ->name('replicate-many');
            Route::get('/search', FormSearchController::class)
                ->name('search');
        });

        Route::prefix(Str::slug(Input::TABLE))->name(Str::slug(Input::TABLE) . '.')->group(function ()
        {
            Route::get('/', InputIndexController::class)
                ->name('index');
            Route::get('/create', InputCreateController::class)
                ->name('create');
            Route::post('/', InputStoreController::class)
                ->name('store');
            Route::get('/{input}/edit', InputEditController::class)
                ->name('edit');
            Route::patch('/{input}', InputUpdateController::class)
                ->name('update');
            Route::delete('/{input}', InputDestroyController::class)
                ->name('destroy');
            Route::delete('/', InputDestroyManyController::class)
                ->name('destroy-many');
            Route::post('/{input}/replicate', InputReplicateController::class)
                ->name('replicate');
            Route::post('/replicate-many', InputReplicateManyController::class)
                ->name('replicate-many');
        });

        #endregion
    }
);
