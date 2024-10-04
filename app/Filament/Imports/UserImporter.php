<?php

namespace App\Filament\Imports;

use App\Models\User;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Hash;

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
                ->requiredMapping()
                ->rules(['email', 'max:255']),
            ImportColumn::make('password')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('role')
                ->requiredMapping()
                ->relationship(resolveUsing: 'name'),
            ImportColumn::make('first_name')
                ->ignoreBlankState()
                ->rules(['max:255']),
            ImportColumn::make('last_name')
                ->ignoreBlankState()
                ->rules(['max:255']),
            ImportColumn::make('phone')
                ->ignoreBlankState()
                ->rules(['max:20']),
            ImportColumn::make('address')
                ->ignoreBlankState(),
            ImportColumn::make('gender')
                ->ignoreBlankState()
                ->rules(['max:255']),
            ImportColumn::make('original_email')
                ->ignoreBlankState()
                ->rules(['email', 'max:255']),
            ImportColumn::make('is_profile_complete')
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('bio')
                ->ignoreBlankState(),
            ImportColumn::make('year')
                ->ignoreBlankState()
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('status')
                ->ignoreBlankState()
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('avatar_url')
                ->ignoreBlankState()
                ->rules(['max:255']),
            ImportColumn::make('roll_no')
                ->ignoreBlankState()
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?User
    {
        return User::firstOrNew([
            'email' => $this->data['email'],
            'original_email' => $this->data['original_email'],
        ]);

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
