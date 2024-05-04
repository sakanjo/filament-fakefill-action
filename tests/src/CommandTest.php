<?php

use Livewire\Livewire;
use SaKanjo\FilamentFakeFillAction\Tests\Models\User;
use SaKanjo\FilamentFakeFillAction\Tests\Panels\Admin\Resources\UserResource\Pages;

it('fake fills the form correctly on the create page', function () {
    Livewire::test(Pages\CreateUser::class)
        ->callAction('fill')
        ->assertFormSet([
            'name' => 'Name from factory',
            'state' => 'State from factory',
        ]);
});

it('fake fills the form correctly on the edit page', function () {
    $user = User::factory()->create();

    Livewire::test(Pages\EditUser::class, [
        'record' => $user->getKey(),
    ])
        ->callAction('fill')
        ->assertFormSet([
            'name' => 'Name from factory',
            'state' => 'State from factory',
        ]);
});
