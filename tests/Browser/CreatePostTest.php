<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Post;
use App\Models\User;

class CreatePostTest extends DuskTestCase
{

    use DatabaseMigrations;

    /**
     * testAuthUserCanCreatePost function
     *
     * @group create-post
     * @return void
     */
    public function testAuthUserCanCreatePost()
    {
        $user = User::factory()->create([
            'email' => 'aadhar@mailinator.com',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/create-post')
                ->type('title', 'New Post')
                ->type('body', 'New Body')
                ->press('Save Post')
                ->assertPathIs('/posts')
                ->assertSee('New Post')
                ->assertSee('New Body');
        });
    }


    /**
     * testOnlyAuthUserCanCreatePost function
     *
     * @group create-post-auth
     * @return void
     */
    public function testOnlyAuthUserCanCreatePost()
    {

        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/create-post')
                ->assertPathIs('/login');
        });
    }
}
