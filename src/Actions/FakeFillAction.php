<?php

namespace SaKanjo\FilamentFakeFillAction\Actions;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Resources\Pages;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

class FakeFillAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'fill';
    }

    public function isVisible(): bool
    {
        /** @var Pages\CreateRecord|Pages\EditRecord $livewire */
        $livewire = $this->livewire;

        return parent::isVisible() &&
            method_exists($livewire->getModel(), 'factory');
    }

    protected function setUp(): void
    {
        parent::setUp();

        $icon = config('filament-fakefill-action.icon');
        $color = config('filament-fakefill-action.color');

        $this
            ->icon($icon)
            ->hiddenLabel()
            ->color($color)
            ->action($this->fill(...));
    }

    protected function fill(Pages\CreateRecord|Pages\EditRecord $livewire): void
    {
        App::bind('fakeFilling', fn () => true);

        /** @var Factory $factory */
        $factory = $livewire->getModel()::factory(); // @phpstan-ignore-line
        $data = $factory->definition();

        $components = $livewire->form->getComponents();

        foreach ($components as $component) {
            if (
                $component instanceof Forms\Components\Field &&
                (
                    $component->isDisabled() ||
                    $component->isHidden() ||
                    $component instanceof Forms\Components\FileUpload
                )
            ) {
                unset($data[$component->getName()]);
            }
        }

        $data = Arr::mapWithKeys($data, function (mixed $value, string $key): array {
            if ($value instanceof BackedEnum) {
                $value = $value->value;
            }

            return [
                "data.$key" => $value,
            ];
        });

        $livewire->fill($data);

        App::bind('fakeFilling', fn () => false);
    }
}
