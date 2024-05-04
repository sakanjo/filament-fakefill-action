<?php

namespace SaKanjo\FilamentFakeFillAction\Tests\Panels\Admin\Resources\UserResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use SaKanjo\FilamentFakeFillAction\Actions\FakeFillAction;
use SaKanjo\FilamentFakeFillAction\Tests\Panels\Admin\Resources\UserResource;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            FakeFillAction::make(),
        ];
    }
}
