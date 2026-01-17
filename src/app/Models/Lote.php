<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'address',
    ];

    public function sellers() {
        return $this->hasMany(Seller::class, 'seller_id','id');
    }
}
