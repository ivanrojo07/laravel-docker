<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    //
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'lote_id',
    ];


    public function lote(){
        return $this->belongsTo(Lote::class,'seller_id','id');
    }
}
