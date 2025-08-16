<?php

use SaKanjo\FilamentFakeFillAction\Tests\Models\User;
use SaKanjo\FilamentFakeFillAction\Tests\Panels\Admin\Resources\UserResource\Pages;

use function Pest\Livewire\livewire;

it('fake fills the form correctly on the create page', function () {
    livewire(Pages\CreateUser::class)
        ->callAction('fill')
        ->assertSchemaStateSet([
            'name' => 'Name from factory',
            'state' => 'State from factory',
        ]);
});

it('fake fills the form correctly on the edit page', function () {
    $user = User::factory()->create();

    livewire(Pages\EditUser::class, [
        'record' => $user->getKey(),
    ])
        ->callAction('fill')
        ->assertSchemaStateSet([
            'name' => 'Name from factory',
            'state' => 'State from factory',
        ]);
});
