<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
   protected $table = 'comment';

   public function tintuc(){
       return $this->belongsTo('App\Tintuc','idTinTuc', 'id');
   }

   public function user(){
       return $this->hasMany('App\User','idUser','id');
   }
}
