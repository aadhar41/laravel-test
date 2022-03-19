<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use App\Models\Post;
use Illuminate\Support\Str;

class ViewAllBlogPostTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @group posts
     *
     * @return void
     */
    public function test_can_view_all_blog_posts()
    {
        // 1. Arrange
        $post1 = Post::factory()->create();
        $post2 = Post::factory()->create();

        // $post1 =  Post::create([
        //     'title' => $this->faker->name(),
        //     'body' => $this->faker->paragraphs(rand(3, 7), true),
        // ]);
        // $post2 = Post::create([
        //     'title' => $this->faker->name(),
        //     'body' => $this->faker->paragraphs(rand(3, 7), true),
        // ]);


        // 2. Act
        $response = $this->get('/posts');


        // 3. Assert
        $response->assertStatus(200);
        $response->assertSee($post1->title);
        $response->assertSee($post2->title);
        $response->assertSee(Str::limit($post1->body, 20));
        $response->assertSee(Str::limit($post2->body, 20));
    }
}
