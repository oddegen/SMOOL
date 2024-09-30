<?php

use App\Models\GradeComponent;
use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignIdFor(Subject::class)->constrained()->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->foreignIdFor(GradeComponent::class)->constrained()->cascadeOnDelete();
            $table->decimal('score', 5, 2);
            $table->text('remarks')->nullable();
            $table->string('grading_period')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
