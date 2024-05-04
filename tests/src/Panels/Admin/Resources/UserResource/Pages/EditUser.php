<?php

namespace SaKanjo\FilamentFakeFillAction\Tests\Panels\Admin\Resources\UserResource\Pages;

use Filament\Resources\Pages\EditRecord;
use SaKanjo\FilamentFakeFillAction\Actions\FakeFillAction;
use SaKanjo\FilamentFakeFillAction\Tests\Panels\Admin\Resources\UserResource;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            FakeFillAction::make(),
        ];
    }
}
