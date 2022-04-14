<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant', 'ln', 'geo', 'code', 'name', 'category', 'pictures',
        'description', 'summary', 'price', 'oldprice', 'currencyId',
        'url', 'vendor', 'model', 'param',
    ];
}
