<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Like extends Model
{
    protected $guarded = array();

    public function user(){
        return $this->belongsTo(User::class)->latest();
    }

    public function chusqer(){
        return $this->belongsTo(Chusqer::class);
    }

    public static function findLike($chusqerId, $userId){
        return Like::where([
            'chusqer_id' => $chusqerId,
            'user_id' => $userId,
        ])->first();
    }

    public static function hasUserLiked($chusqer){
        $user = Auth::user();
        $like = Like::where([
            'chusqer_id' => $chusqer->id,
            'user_id' => $user->id,
        ])->first();

        return $like !== null ? true : false;
    }
}
