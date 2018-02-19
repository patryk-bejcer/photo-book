<?php

function belongs_to_auth($user_id){
    return (Auth::check() && $user_id === Auth::id());
}

