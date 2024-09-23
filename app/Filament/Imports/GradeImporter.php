<?php

namespace App\Filament\Imports;

use App\Models\Grade;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class GradeImporter extends Importer
{
    protected static ?string $model = Grade::class;

    public function resolveRecord(): ?Grade
    {
        // return Grade::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Grade();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your grade import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->label('Name')
                ->rules(['required', 'string', 'max:255']),
            ImportColumn::make('email')
                ->label('Email')
                ->rules(['required', 'email', 'unique:grades,email']),
            ImportColumn::make('password')
                ->label('Password')
                ->rules(['required', 'string', 'min:8']),
            ImportColumn::make('expires_at')
                ->label('Expires At')
                ->rules(['required', 'date']),
        ];
    }
}
