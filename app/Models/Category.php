<?php

namespace App\Models;

use App\Models\CategorySetting;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'status',
        'amount'
    ];

    const STATUS = [
        'INACTIVE' => 0,
        'ACTIVE' => 1
    ];

    const TYPE = [
        'FIX' => 1,
        'FREE' => 2
    ];
}
