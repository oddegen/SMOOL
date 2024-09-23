<?php

use App\Models\Event;
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
        Schema::create('event_section', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Event::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Section::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_section');
    }
};
