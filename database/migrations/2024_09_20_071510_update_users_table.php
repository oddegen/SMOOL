<?php

use App\Models\Role;
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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(Role::class)->nullable()->constrained()->nullOnDelete();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable()->change();
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('avatar')->nullable();
            $table->string('original_email')->unique()->nullable();
            $table->boolean('is_profile_complete')->default(false);
            $table->text('bio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('role_id');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->string('email')->change();
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('gender');
            $table->dropColumn('avatar');
            $table->dropColumn('original_email');
            $table->dropColumn('is_profile_complete');
        });
    }
};
