<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use Illuminate\Support\Facades\Artisan;

class ViewABlogPostTest extends TestCase
{
    use RefreshDatabase;
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

    public function test_can_view_a_blog_post()
    {

        Artisan::call("migrate");

        // 1. Arrangement
        // creating a blog post
        $post = Post::create([
            'title' => 'A Simple Title',
            'body' => 'A Simple Body',
        ]);
        // 2. Action
        $response = $this->get("/post/{$post->id}");
        // 3. Assert
        // assert status code 200
        $response->assertStatus(200);
        // assert that we see post title
        $response->assertSee($post->title);
        // assert that we see post body
        $response->assertSee($post->body);
        // assert that we see published date
        // $response->assertSee($post->created_at);
        $response->assertSee($post->created_at->toFormattedDateString());
    }


    /**
     * @group post-not-found
     *
     * @return void
     */
    public function test_views_a_404_page_when_post_is_not_found()
    {
        // 1. Action
        $response = $this->get("/post/INVALID_ID");

        // 2. Assert
        $response->assertStatus(404);

        $response->assertSee("The page you are looking for could not be found.");
    }
}
