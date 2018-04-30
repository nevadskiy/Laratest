<?php

namespace Tests\Feature;

use App\Team;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_team_has_a_name()
    {
        // Given
        $team = new Team(['name' => 'Acme']);
        // When
        
        // Then
        $this->assertEquals('Acme', $team->name);
    }

    public function test_a_team_can_add_members()
    {
        $team = factory(Team::class)->create();

        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $team->add($user1);
        $team->add($user2);

        $this->assertEquals(2, $team->count());
    }

    /** @test */
    public function it_has_max_size()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $team->add($user1);
        $team->add($user2);

        $this->assertEquals(2, $team->count());
        
        $this->expectException(\Exception::class);
        $user3 = factory(User::class)->create();
        $team->add($user3);
    }

    /** @test */
    public function it_can_remove_a_member()
    {
        // Get
        $team = factory(Team::class)->create(['size' => 5]);
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $team->add($user1);
        $team->add($user2);

        $this->assertEquals(2, $team->count());

        // When
        $team->remove($user1);

        // Then
        $this->assertEquals(1, $team->count());
        $this->assertEquals($user2->id, $team->members()->first()->id);
    }

    /** @test */
    public function it_can_remove_all_members()
    {   
        // Get
        $team = factory(Team::class)->create(['size' => 5]);
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $team->add($user1);
        $team->add($user2);

        $this->assertEquals(2, $team->count());

        // When
        $team->flush();

        // Then
        $this->assertEquals(0, $team->count());
    }
}
