<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant', 'ln', 'code', 'name', 'category', 'pictures',
        'description', 'price', 'oldprice', 'currencyId',
        'url', 'vendor', 'model', 'param',
    ];
}
