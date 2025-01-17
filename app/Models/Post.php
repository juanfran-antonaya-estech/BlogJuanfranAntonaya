<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function comentarios() {
        return $this->hasMany(Comentario::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
