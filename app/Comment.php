<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [ 'user_id', 'image_id', 'album_id', 'type', 'body'];

	public function getFieldAttribute()
	{
		return $this->attributes['first_name'] + $this->attributes['last_name'];
	}

	public function getSomeFieldAttribute()
	{
		return $this->attributes['created_at']->format('Y-m-d');
	}

}
