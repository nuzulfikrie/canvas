<?php

namespace Orchestra\Canvas\Tests\Feature\Generators;

class PolicyTest extends TestCase
{
    protected $files = [
        'app/Policies/FooPolicy.php',
    ];

    /** @test */
    public function it_can_generate_policy_file()
    {
        $this->artisan('make:policy', ['name' => 'FooPolicy'])
            ->assertExitCode(0);

        $this->assertFileContains([
            'namespace App\Policies;',
            'use App\User;',
            'class FooPolicy',
        ], 'app/Policies/FooPolicy.php');
    }

    /** @test */
    public function it_can_generate_policy_with_model_options_file()
    {
        $this->artisan('make:policy', ['name' => 'FooPolicy', '--model' => 'Post'])
            ->assertExitCode(0);

        $this->assertFileContains([
            'namespace App\Policies;',
            'use App\Post;',
            'use App\User;',
            'class FooPolicy',
            'public function viewAny(User $user)',
            'public function view(User $user, Post $post)',
            'public function create(User $user)',
            'public function update(User $user, Post $post)',
            'public function delete(User $user, Post $post)',
            'public function restore(User $user, Post $post)',
            'public function forceDelete(User $user, Post $post)',
        ], 'app/Policies/FooPolicy.php');
    }
}