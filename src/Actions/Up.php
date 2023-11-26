<?php declare(strict_types=1);

namespace Antwerpes\FilamentNestedSetOrder\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Cache;

class Up extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label(__('up'))
            ->icon('heroicon-s-arrow-circle-up')
            ->iconButton()
            ->action(static fn ($record) => $record->moveOrderUp())
            ->visible(static function ($record) {
                $first = config('filament-nested-set-order.cache_enabled')
                    ? Cache::rememberForever(
                        $record->getOrderableCachePrefix().'-first',
                        static fn () => $record->buildSortQuery()->ordered()->first(),
                    )
                    : $record->buildSortQuery()->ordered()->first();

                return $record->id !== $first?->id;
            });
    }
}
