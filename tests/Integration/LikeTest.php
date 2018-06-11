<?php

namespace Tests\Integration;

use Tests\TestCase;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_like_a_post()
    {
       // Given:
       // I have a post and user and user is logged in
       $post = factory(Post::class)->create();
       $user = factory(User::class)->create();
       $this->actingAs($user);

       // When: 
       // He likes a post
       $post->like();

       // Then:
       // I see evidence in the database and post is liked
       $this->assertDatabaseHas('likes', [
           'user_id' => $user->id,
           'likeable_id' => $post->id,
           'likeable_type' => get_class($post)
       ]);

       $this->assertTrue($post->isLiked());
    }

    /** @test */
    public function a_user_can_unlike_a_post()
    {
        // Given:
        // I have a post and user and user is logged in
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        // When:
        // He unlikes a post
        $post->unlike();

        // Then:
        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);

        $this->assertFalse($post->isLiked());
    }

    /** @test */
    public function a_user_may_toggle_a_post_like_status()
    {
        // Given:
        // I have a post and user and user is logged in
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        // Then
        $post->toggle();

        $this->assertTrue($post->isLiked());

        // And
        $post->toggle();

        $this->assertFalse($post->isLiked());
    }

    /** @test */
    public function a_post_knows_how_many_likes_it_has()
    {
        // Given:
        // I have a post and user and user is logged in
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $post->toggle();

        $this->assertEquals(1, $post->likesCount);
    }
}