<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $fillable = ['kullanici_id','kategori','onem','baslik','aciklama','okundu','cevaplar'];

    public function kimden(){
    	return $this->hasOne('App\User','id','kullanici_id');
    }
    
}
