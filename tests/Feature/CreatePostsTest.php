<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;

class CreatePostsTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    /**
     * @group create-post
     *
     * @return void
     */
    public function test_can_create_post()
    {
        // 1. Arrange


        // 2. Action
        $response = $this->post('/create-post', [
            'title' => 'new post title',
            'body' => 'new post body',
        ]);

        // 3. Assert
        $this->assertDatabaseHas('posts', [
            'title' => 'new post title',
            'body' => 'new post body',
        ]);

        $post = Post::find(1);

        $this->assertEquals('new post title', $post->title);
        $this->assertEquals('new post body', $post->body);
    }


    /**
     * @group post-validation-title
     *
     * @return void
     */
    public function test_title_is_required_to_create_post()
    {
        // 1. Arrange


        // 2. Action
        $response = $this->post('/create-post', [
            'title' => null,
            'body' => 'new post body',
        ]);

        // 3. Assert
        $response->assertSessionHasErrors('title');
    }


    /**
     * @group post-validation-body
     *
     * @return void
     */
    public function test_body_is_required_to_create_post()
    {
        // 1. Arrange


        // 2. Action
        $response = $this->post('/create-post', [
            'title' => 'new post body',
            'body' => null,
        ]);

        // 3. Assert
        $response->assertSessionHasErrors('body');
    }
}
