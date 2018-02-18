<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
   protected $fillable = [ 'user_id', 'path', 'visible_level', 'permission' ];

   public function user(){
	   return $this->hasOne('App\User', 'id', 'user_id');
   }

}
