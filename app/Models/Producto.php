<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    public function seller() {
        return $this->belongsTo(User::class);
    }
}
