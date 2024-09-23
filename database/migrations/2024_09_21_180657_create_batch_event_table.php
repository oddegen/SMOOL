<?php

use App\Models\Batch;
use App\Models\Event;
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
        Schema::create('batch_event', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Batch::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Event::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_event');
    }
};
