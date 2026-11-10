
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
        Schema::create('places', function (Blueprint $table) {
            // Create the primary key.
            $table->id();

            // Store the city name and its URL-friendly identifier.
            $table->text('name');
            $table->text('slug');

            // Store the geographical coordinates.
            $table->float('latitude');
            $table->float('longitude');

            // Automatically manage creation and update timestamps.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the places table.
        Schema::dropIfExists('places');
    }
};
