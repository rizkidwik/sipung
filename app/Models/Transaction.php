<?php

namespace App\Models;

use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'donatur_id',
        'user_id',
        'total'
    ];
    

    public function details(){
        return $this->hasMany(TransactionDetail::class,'transaction_id');
    }

    public function donatur(){
        return $this->belongsTo(Donatur::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected function createdAtFormat(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value),
        );
    }
}