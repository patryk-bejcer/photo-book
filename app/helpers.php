<?php

use Ghanem\Rating\Models\Rating;

function belongs_to_auth($user_id){
    return (Auth::check() && $user_id === Auth::id());
}

function getUserRateImage($image_id){

	$userRate = Rating::where([
		'ratingable_type' => 'App\Images',
		'ratingable_id' => $image_id,
		'author_id' => Auth::id(),
	])->first();

	if($userRate){
		return $userRate;
	} else {
		return false;
	}

}
