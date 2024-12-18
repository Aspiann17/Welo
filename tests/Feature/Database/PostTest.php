<?php

use Illuminate\Database\UniqueConstraintViolationException;

use App\Models\Post;
use Database\Seeders\PostSeeder;

test('post can be updated successfully', function () {
    $this->seed(PostSeeder::class);
    $post = Post::findOrFail(1);

    expect($post->slug)->toBe('kage-no-jitsuryokusha-ni-naritakute');

    $post->title = 'Kagejitsu!';
    $post->save();

    expect($post->slug)->toBe('kagejitsu');
});

test('post can be deleted successfully', function () {
    $this->seed(PostSeeder::class);

    $post = Post::findOrFail(2);
    $post->delete();

    $this->assertSoftDeleted($post);
});

test('throws error on duplicate slug', function () {
    $this->seed(PostSeeder::class);

    Post::factory()->create([
        'title' => 'Laravel'
    ]);

})->throws(UniqueConstraintViolationException::class);
