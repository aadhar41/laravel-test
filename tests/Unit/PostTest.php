<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Post;
use Illuminate\Support\Facades\Artisan;


class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     * @group formatted-date
     *
     * @return void
     */
    public function test_can_get_created_at_formated_date()
    {
        // $this->assertTrue(true);
        // 1. Arrange
        // create a post
        $post = Post::create([
            'title' => 'A Simple Title',
            'body' => 'A Simple Body',
        ]);

        // 2. Act
        // get the value by calling the method
        $formattedDate = $post->createdAt();

        // 3. Assert
        // assert that returned value is as we expect
        $this->assertEquals(
            $post->created_at->toFormattedDateString(),
            $formattedDate
        );
    }
}
