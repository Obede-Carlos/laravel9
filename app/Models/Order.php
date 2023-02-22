<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function client(){
        //Tal como hemos explicado en la tabla Client, aqui pondremos BelongsTo() ya que es la tabla hija y pertenece a cliente
        
        //return $this->belongsTo(Client::class);
        //En las relaciones 1:n se deja como está, la relación es la misma


        //Para relaciones N:M
        return $this->belongsToMany(Client::class);
    }

    //protected $cast = ["fecha" => "datetime:d-m-y"];

    //sintaxis para laravel9.
    public function Fecha(): Attribute
    {
        return new Attribute(
            fn($value) => Carbon::parse($value)->format("[d*m*y]"),
            fn($value) => Carbon::parse($value)-> format("d/m/y"),
        );
    }
}
