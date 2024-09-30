<?php

use App\Models\Section;
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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('student_id')->references('id')->on('users')->comment("Student")->constrained()->cascadeOnDelete();
            $table->foreign('teacher_id')->references('id')->on('users')->comment("Teacher")->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Section::class)->constrained()->cascadeOnDelete();
            $table->string('status')->default('unknown');
            $table->timestamp('time')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
