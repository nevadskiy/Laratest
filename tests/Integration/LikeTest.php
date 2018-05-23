<?php

// namespace Tests\Integration;

use Tests\TestCase;
use App\Post;
use App\User;

class LikeTest extends TestCase
{
    /** @test */
    public function test_a_user_can_like_a_post()
    {
       // Given:
       // I have a post and user and user is logged in
       $post = factory(Post::class)->create();
       $user = factory(User::class)->create();
       $this->actingAs($user);

       // When: 
       // He likes a post
       $post->like();

       $this->assertTrue(false);

       // Then:
       // I see evidence in the database and post is liked
       $this->seeInDatabase('likes', [
           'user_id' => $user->id,
           'likeable_id' => $post->id,
           'likeable_type' => get_class($post)
       ]);
    }
}