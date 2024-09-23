<?php

use App\Models\Batch;
use App\Models\Section;
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
        Schema::create('batch_section', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Section::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Batch::class)->constrained()->cascadeOnDelete();
            $table->year('year')->default(now()->year);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_section');
    }
};
