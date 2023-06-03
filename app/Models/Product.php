<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','name','unit','stock','selling_price','selling_price_resellers','image'];
    protected $table = 'product';
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
