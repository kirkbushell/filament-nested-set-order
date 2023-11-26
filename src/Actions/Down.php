<?php declare(strict_types=1);

namespace Antwerpes\FilamentNestedSetOrder\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Cache;

class Down extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label(__('down'))
            ->icon('heroicon-s-arrow-circle-up')
            ->iconButton()
            ->action(static fn ($record) => $record->moveOrderUp())
            ->visible(static function ($record) {
                $last = config('filament-nested-set-order.cache_enabled')
                    ? Cache::rememberForever(
                        $record->getOrderableCachePrefix().'-last',
                        static fn () => $record->buildSortQuery()->ordered()->last(),
                    )
                    : $record->buildSortQuery()->ordered()->last();

                return $record->id !== $last?->id;
            });
    }
}
