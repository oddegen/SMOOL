<?php

use App\Models\Batch;
use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->foreignIdFor(Subject::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Batch::class)->nullable()->constrained()->nullOnDelete();
            $table->year('school_year')->default(now()->year)->nullable();
            $table->dropColumn('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropConstrainedForeignId('subject_id');
            $table->dropColumn('school_year');
            $table->string('title')->nullable();
        });
    }
};
