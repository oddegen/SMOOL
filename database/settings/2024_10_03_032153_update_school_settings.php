<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('school.domain', 'school');
    }

    public function down(): void
    {
        $this->migrator->delete('school.domain');
    }
};
