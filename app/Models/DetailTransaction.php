<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailTransaction extends Model
{
    use HasFactory;
    protected $table = 'detail_transaction';


    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class,'transaction_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id');
    }


}
