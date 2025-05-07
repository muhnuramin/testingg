<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    protected $fillable=[
        'name','description','categori_id'
    ];

    public function categori():BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }
}
