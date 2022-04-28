<?php

use App\Http\Controllers\OfferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/presents/{merchant}', [OfferController::class, 'presents']);
Route::get('/presents/{code}/description', [OfferController::class, 'presentsDescription']);
Route::get('/presents/{code}/name', [OfferController::class, 'presentsName']);

Route::get('/search', [OfferController::class, 'search']);

