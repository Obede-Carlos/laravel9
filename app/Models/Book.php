<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function publisher()
    {
        //Realcion 1:n una editorial puede tener varios libros publicados
        return $this->belongsTo(Publisher::class);
    }
}
