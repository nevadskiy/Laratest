<?php

namespace Tests\Integration;

use Tests\TestCase;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    protected $post;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        // Given
        $this->post = factory(Post::class)->create();
        $this->signIn();
    }

    /** @test */
    public function a_user_can_like_a_post()
    {
       // When:
       // He likes a post
       $this->post->like();

       // Then:
       // I see evidence in the database and post is liked
       $this->assertDatabaseHas('likes', [
           'user_id' => $this->user->id,
           'likeable_id' => $this->post->id,
           'likeable_type' => get_class($this->post)
       ]);

       $this->assertTrue($this->post->isLiked());
    }

    /** @test */
    public function a_user_can_unlike_a_post()
    {

        // When:
        // He unlikes a post
        $this->post->unlike();

        // Then:
        $this->assertDatabaseMissing('likes', [
            'user_id' => $this->user->id,
            'likeable_id' => $this->post->id,
            'likeable_type' => get_class($this->post)
        ]);

        $this->assertFalse($this->post->isLiked());
    }

    /** @test */
    public function a_user_may_toggle_a_post_like_status()
    {
        // Then
        $this->post->toggle();

        $this->assertTrue($this->post->isLiked());

        // And
        $this->post->toggle();

        $this->assertFalse($this->post->isLiked());
    }

    /** @test */
    public function a_post_knows_how_many_likes_it_has()
    {

        $this->post->toggle();

        $this->assertEquals(1, $this->post->likesCount);
    }
}