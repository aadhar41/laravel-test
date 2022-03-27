<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Post;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Undocumented function
     * 
     * @group login
     * @return void
     */
    public function testAUserCanLogin()
    {
        $user = User::factory()->create([
            'email' => 'aadhar@mailinator.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('Login')
                ->assertPathIs('/home');
        });
    }


    /**
     * testAUserCanViewAPost function
     *
     * @group posts-page
     * @return void
     */
    public function testAUserCanViewAPost()
    {
        // $post = Post::factory()->create();
        $post = Post::factory()->create([
            'title' => 'This is the title',
            'body' => 'new post body',
        ]);

        $this->browse(function ($browser) use ($post) {
            $browser->visit('/posts')
                ->clickLink('View Post Details')
                ->assertPathIs("/post/{$post->id}")
                ->assertSee($post->title)
                ->assertSee($post->body)
                ->assertSee($post->createdAt());
        });
    }
}
