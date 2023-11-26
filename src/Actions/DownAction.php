<?php declare(strict_types=1);

namespace Antwerpes\FilamentNestedSetOrder\Actions;

use Filament\Tables\Actions\Action;

class DownAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->icon('heroicon-s-arrow-down-circle')
            ->iconButton()
            ->action(static fn ($record) => $record->moveOrderUp())
            ->visible(static function ($record) {
                $last = $record->buildSortQuery()->ordered('desc')->first();

                return $record->id !== $last?->id;
            });
    }
}
