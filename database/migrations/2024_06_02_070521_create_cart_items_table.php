<?php

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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Ensure foreign key constraint
            $table->string('name'); // For product name
            $table->integer('qty'); // For quantity
            $table->decimal('price', 10, 2); // For price with two decimal places
            $table->decimal('weight', 8, 2); // For weight with two decimal places
            $table->json('options'); // For additional options (image, color, size)
            $table->integer('discount')->default(0);
            $table->integer('tax')->default(0);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
