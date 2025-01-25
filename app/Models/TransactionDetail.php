<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'transaction_id',
        'item_id',
        'amount'
    ];

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }

    public function item(){
        return $this->belongsTo(Category::class);
    }
}
