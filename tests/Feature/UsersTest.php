<?php

namespace Tests\Feature;

use App\Chusqer;
use App\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use DatabaseTransactions;
    use InteractsWithDatabase;

    public function testUserCanSeeLikes()
    {
        $user = factory(User::class)->create();
        $chusqer = factory(Chusqer::class)->create([
            'user_id' => $user->id,
        ]);

        $this->get("/{$chusqer->id}/likes")->assertStatus(200);
    }

    public function testUserCanLike()
    {
        $user = factory(User::class)->create();
        $chusqer = factory(Chusqer::class)->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)->get("/chusqers/{$chusqer->id}/like");
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'chusqer_id' => $chusqer->id
        ]);
    }

    public function testUserCanDislike(){
        $user = factory(User::class)->create();
        $chusqer = factory(Chusqer::class)->create([
            'user_id' => $user->id,
        ]);

        //El usuario da like al chusqer
        $this->actingAs($user)->get("/chusqers/{$chusqer->id}/like");
        //El usuario quita el like al chusqer
        $this->actingAs($user)->get("/chusqers/{$chusqer->id}/like");
        //Comprueba que el like no existe en la base de datos
        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'chusqer_id' => $chusqer->id
        ]);
    }

//    /**
//     * @test
//     */
//    public function userCanFollowOtherUser()
//    {
//        $user = factory(User::class)->create();
//        $other = factory(User::class)->create();
//
//        $this->actingAs($user)->post($other->slug.'/follow');
//
//        $this->assertDatabaseHas('followers',[
//            'user_id' => $user->id,
//            'followed_id' => $other->id,
//        ]);
//    }
//
//    /**
//     * @test
//     */
//    public function userCanLogin()
//    {
//        $user = factory(User::class)->create();
//
//        $this->post('/login', [
//            'email' => $user->email,
//            'password' => 'secret'
//        ]);
//
//        $this->assertAuthenticatedAs($user);
//    }
//
//    public function testShowUserPage()
//    {
//        $user = factory(User::class)->create();
//
//        $response = $this->get('/'.$user->slug);
//
//        $response->assertStatus(200);
//    }
}
