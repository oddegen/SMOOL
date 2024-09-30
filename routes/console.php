<?php

use App\Jobs\CreateDailyAttendanceRecords;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::job(new CreateDailyAttendanceRecords())
    ->dailyAt('00:01')
    ->onSuccess(function () {
        Log::info('Daily attendance records created successfully');
    })
    ->onFailure(function (\Throwable $e) {
        Log::error('Failed to create daily attendance records: ' . $e->getMessage());
    });
