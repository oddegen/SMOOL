<?php

namespace App\Jobs;

use App\Models\Attendance;
use App\Models\Role;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateDailyAttendanceRecords implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            echo "Starting CreateDailyAttendanceRecords job\n";
            Log::info('Starting CreateDailyAttendanceRecords job');

            $today = now()->toDateString();
            Log::info("Processing for date: {$today}");

            $teacherRole = Role::firstWhere('name', 'Teacher');
            if (!$teacherRole) {
                throw new \Exception('Teacher role not found');
            }

            User::query()
                ->where('role_id', $teacherRole->id)
                ->chunk(100, function ($teachers) use ($today) {
                    foreach ($teachers as $teacher) {
                        $this->processTeacherSchedules($teacher, $today);
                    }
                });

            Log::info('CreateDailyAttendanceRecords job completed successfully');
        } catch (\Exception $e) {
            echo "Error in CreateDailyAttendanceRecords job: " . $e->getMessage() . "\n";
            echo "Stack trace: " . $e->getTraceAsString() . "\n";
            Log::error('Error in CreateDailyAttendanceRecords job: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            throw $e;
        }
    }

    private function processTeacherSchedules(User $teacher, string $date): void
    {
        try {
            Log::info("Processing schedules for teacher ID: {$teacher->id}");

            $schedules = Schedule::where('user_id', $teacher->id)
                ->whereDate('starts_at', $date)
                ->with(['section.sectionUsers' => function ($query) use ($teacher) {
                    $query->where('teacher_id', $teacher->id)
                        ->where('year', now()->year) // Apply the current year filter directly
                        ->with('student');
                }])
                ->get();

            Log::info("Found " . $schedules->count() . " schedules for teacher");

            $attendanceRecords = [];

            foreach ($schedules as $schedule) {
                foreach ($schedule->section->sectionUsers as $sectionUser) {
                    $attendanceRecords[] = [
                        'student_id' => $sectionUser->student->id,
                        'teacher_id' => $teacher->id,
                        'section_id' => $schedule->section_id,
                    ];
                }
            }

            Log::info("Inserting " . count($attendanceRecords) . " attendance records");

            // Use insertOrIgnore to prevent duplicate entries
            Attendance::insertOrIgnore($attendanceRecords);

            Log::info("Finished processing for teacher ID: {$teacher->id}");
        } catch (\Exception $e) {
            Log::error("Error processing teacher ID {$teacher->id}: " . $e->getMessage());
            throw $e;
        }
    }
}
