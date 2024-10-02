<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use TomatoPHP\FilamentInvoices\Models\Invoice;
use Filament\Tables\Enums\FiltersLayout;
use TomatoPHP\FilamentTypes\Components\TypeColumn;

class InvoiceTable extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Invoices')
            ->query(
                Invoice::query()
            )
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label(trans('filament-invoices::messages.invoices.columns.uuid'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('for_id')
                    ->state(fn($record) => $record->for_type::find($record->for_id)?->name)
                    ->label(trans('filament-invoices::messages.invoices.columns.account'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bank_account_owner')
                    ->label('Bank Account Owner')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('date')
                    ->label(trans('filament-invoices::messages.invoices.columns.date'))
                    ->date()
                    ->sortable(),
                TypeColumn::make('status')
                    ->badge()
                    ->label(trans('filament-invoices::messages.invoices.columns.status'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->label(trans('filament-invoices::messages.invoices.columns.total'))
                    ->money(fn($record) => $record->currency?->iso)
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(function () {
                        return \TomatoPHP\FilamentTypes\Models\Type::query()
                            ->where('for', 'invoices')
                            ->where('type', 'status')
                            ->pluck('name', 'key')
                            ->toArray();
                    })
                    ->label(trans('filament-invoices::messages.invoices.filters.status'))
                    ->multiple()
                    ->searchable(),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\Action::make('view')
                    ->url(fn(Invoice $record): string => route('filament.admin.resources.invoices.view', $record))
                    ->icon('heroicon-s-eye')
                    ->label(trans('filament-invoices::messages.invoices.actions.view_invoice')),
            ])
            ->paginated([10, 25, 50, 100]);
    }
}
