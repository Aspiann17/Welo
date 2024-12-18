<?php

use Illuminate\Database\UniqueConstraintViolationException;
use Database\Seeders\UserSeeder;
use App\Models\User;

test('user can be created successfully', function () {
    $this->seed(UserSeeder::class);

    $user = User::where('name', 'Aspian')->first();

    expect($user->name)->toBe('Aspian');
    expect($user->email)->toBe('aspian@ganteng.id');
    expect($user->role)->toBe('admin');
});

test('user data can be updated successfully', function () {
    $this->seed(UserSeeder::class);
    $user = User::find(1);

    expect($user->name)->toBe('Aspian');
    expect($user->email)->toBe('aspian@ganteng.id');

    $user->name = 'Abdul';
    $user->email = 'abdul@mail.id';
    $user->save();

    $abdul = $user->refresh();
    expect($abdul->name)->toBe('Abdul');
    expect($abdul->email)->toBe('abdul@mail.id');
});

test('user soft delete works as expected', function () {
    $this->seed(UserSeeder::class);
    $user = User::where('name', 'Kuro')->first();

    expect($user->name)->toBe('Kuro');
    expect($user->deleted_at)->toBeNull();

    $user->delete();

    expect($user->name)->toBe('Kuro');
    expect($user->deleted_at)->not()->toBeNull();
});

test('error is thrown when user name is duplicated', function () {
    $this->seed(UserSeeder::class);

    User::factory()->create([
        'name' => 'Aspian',
    ]);

})->throws(UniqueConstraintViolationException::class);

test('error is thrown when user email is duplicated', function () {
    $this->seed(UserSeeder::class);

    User::factory()->create([
        'email' => 'aspian@ganteng.id'
    ]);

})->throws(UniqueConstraintViolationException::class);
