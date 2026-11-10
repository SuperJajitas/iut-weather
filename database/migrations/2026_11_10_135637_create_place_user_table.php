
<?php

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
        Schema::create('place_user', function (Blueprint $table) {
            // Create foreign keys referencing places and users.
            $table->foreignId('place_id')->constrained('places');
            $table->foreignId('user_id')->constrained('users');

            // Store user preferences for each city.
            $table->boolean('is_favorite')->default(false);
            $table->boolean('send_forecast')->default(false);

            // Ensure that each user can only register a city once.
            $table->primary(['place_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the pivot table.
        Schema::dropIfExists('place_user');
    }
};
