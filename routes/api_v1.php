<?php

use App\Http\Controllers\OfferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/presents/{merchant}', [OfferController::class, 'presents']);

Route::get('/search', [OfferController::class, 'search']);
