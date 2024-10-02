<?php

namespace App\Filament\Imports;

use App\Models\User;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class UserImporter extends Importer
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('email')
                ->rules(['email', 'max:255']),
            ImportColumn::make('email_verified_at')
                ->rules(['email', 'datetime']),
            ImportColumn::make('password')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('role_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('first_name')
                ->rules(['max:255']),
            ImportColumn::make('last_name')
                ->rules(['max:255']),
            ImportColumn::make('phone')
                ->rules(['max:20']),
            ImportColumn::make('address'),
            ImportColumn::make('gender')
                ->rules(['max:255']),
            ImportColumn::make('original_email')
                ->rules(['email', 'max:255']),
            ImportColumn::make('is_profile_complete')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('bio'),
            ImportColumn::make('year')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('status')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('custom_fields'),
            ImportColumn::make('avatar_url')
                ->rules(['max:255']),
            ImportColumn::make('roll_no')
                ->rules(['max:255']),
            ImportColumn::make('welcome_valid_until')
                ->rules(['datetime']),
        ];
    }

    public function resolveRecord(): ?User
    {
        // return User::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new User();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your user import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
