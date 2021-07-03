<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacto extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="contacto";

    protected static function booted() {
      static::deleted(function ($user) {
        $user->phones()->delete();
        $user->emails()->delete();
        $user->address()->delete();
      });
    }

    public function phones(){
      return $this->hasMany(Phones::class,'user_phone_fk','id');
    }
    public function emails() {
      return $this->hasMany(Emails::class,'user_email_fk','id');
    }
    public function address() {
      return $this->hasMany(Address::class,'user_address_fk','id');
    }
}
