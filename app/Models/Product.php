<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'name',
        'image',
        'description',
        'quantity',
        'status',
        'seller_id'
    ];
    public function seller() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
