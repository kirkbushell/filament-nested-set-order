<?php declare(strict_types=1);

namespace Antwerpes\FilamentNestedSetOrder\Actions;

use Filament\Tables\Actions\Action;

class UpAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->icon('heroicon-s-arrow-up-circle')
            ->iconButton()
            ->action(static fn ($record) => $record->moveOrderUp())
            ->visible(static function ($record) {
                $first = $record->buildSortQuery()->ordered()->first();

                return $record->id !== $first?->id;
            });
    }
}
