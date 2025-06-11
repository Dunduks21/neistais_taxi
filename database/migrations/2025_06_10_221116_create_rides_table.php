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
        Schema::create('rides', function (Blueprint $table) {
            $table->id();

            // Svešatslēgas uz users tabulu
            $table->foreignId('customer_id')->constrained('users');
            $table->foreignId('driver_id')->constrained('users');

            $table->string('route_start');
            $table->string('route_end');
            $table->float('distance');
            $table->date('ride_date')->nullable();
            $table->enum('status', ['planned', 'ongoing', 'completed', 'cancelled']);
            $table->timestamp('cancelled_at')->nullable(); // ✅ Jauns lauks

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
