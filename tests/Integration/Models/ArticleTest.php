<?php

namespace Tests\Integration\Models;

use Tests\TestCase;
use App\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    // Rollback after test so env still the same
    use RefreshDatabase;
    public function test_it_fetching_trending_articles()
    {
        // Given
        factory(Article::class, 3)->create();
        factory(Article::class)->create(['reads' => 10]);
        $mostPopular = factory(Article::class)->create(['reads' => 20]);

        // When
        $articles = Article::trending()->get();

        // Then
        $this->assertEquals($mostPopular->id, $articles->first()->id);
        $this->assertCount(3, $articles);
    }
}