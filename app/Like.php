<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Like extends Model
{
    protected $guarded = array();

    /**
     * Relacion Like/User, un like pertenece a un usuario
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function user(){
        return $this->belongsTo(User::class)->latest();
    }

    public function chusqer(){
        return $this->belongsTo(Chusqer::class);
    }

    /**
     * Funcion que busca un like cuyo user_id y chusqer_id sean los recibidos
     * @param $chusqerId int Id del chusqer.
     * @param $userId int Id del usuario-
     * @return mixed Devuelve el like, si no lo encuentra devuelve null
     */
    public static function findLike($chusqerId, $userId){
        return Like::where([
            'chusqer_id' => $chusqerId,
            'user_id' => $userId,
        ])->first();
    }

    /**
     * Funcion que devuelve true si el usuario logeado ya ha dado like al chusqer
     * recibido por parametro, sino devuelve false.
     * @param $chusqer Chusqer Chusquer a comprobar.
     * @return bool
     */
    public static function hasUserLiked($chusqer){
        $user = Auth::user();
        $like = Like::where([
            'chusqer_id' => $chusqer->id,
            'user_id' => $user->id,
        ])->first();

        return $like !== null ? true : false;
    }
}
