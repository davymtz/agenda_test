<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phones extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="phones";

    public function contacto(){
      return $this->belongsTo(Contacto::class,'user_phone_fk','id');
    }
}
