<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('school.name', 'Our School');
        $this->migrator->add('school.email', 'our_school@school.com');
        $this->migrator->add('school.phone', '1234567890');
        $this->migrator->add('school.address', '123, School Street, School City');
        $this->migrator->add('school.info', 'Our School is the best school in the world.');
        $this->migrator->add('school.logo', '');
        $this->migrator->add('school.favicon', '');
        $this->migrator->add('school.theme', 'light');
        $this->migrator->add('school.batch_prefix', 'Grade');
        $this->migrator->add('school.section_prefix', 'Section');
        $this->migrator->add('school.batch_start', '1');
        $this->migrator->add('school.batch_end', '10');
        $this->migrator->add('school.section_suffix_type', 'alphabets');
    }
};
