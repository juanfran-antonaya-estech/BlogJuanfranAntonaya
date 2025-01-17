<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',
        'seller_id'
    ];
    public function seller() {
        return $this->belongsTo(User::class);
    }
}
