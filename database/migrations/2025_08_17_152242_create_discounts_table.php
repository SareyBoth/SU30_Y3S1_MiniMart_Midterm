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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->text('description')->nullable();

            // Defines if the discount is a fixed amount or a percentage
            $table->enum('discount_type', ['fixed', 'percent']);

            // The value (e.g., 15.00 for $15 or 20.00 for 20%)
            $table->decimal('discount_value', 10, 2);

            // Rules for the discount's validity
            $table->timestamp('valid_from')->useCurrent();
            $table->timestamp('valid_until')->nullable();
            $table->decimal('minimum_purchase', 10, 2)->default(0.00);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
