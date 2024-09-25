<?php

use App\Models\User;
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
        Schema::table('section_user', function (Blueprint $table) {
            $table->dropUnique(['section_id', 'user_id', 'year']);
            $table->dropConstrainedForeignIdFor(User::class);

            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('users')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id')->references('id')->on('users')->constrained()->cascadeOnDelete();

            $table->unique(['section_id', 'student_id', 'teacher_id', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('section_user', function (Blueprint $table) {
            $table->dropUnique(['section_id', 'student_id', 'teacher_id', 'year']);
            $table->dropConstrainedForeignId('student_id');
            $table->dropConstrainedForeignId('teacher_id');

            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->unique(['section_id', 'user_id', 'year']);
        });
    }
};
