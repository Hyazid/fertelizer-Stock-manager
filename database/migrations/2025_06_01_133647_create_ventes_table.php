<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function PHPSTORM_META\type;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            //relation with product
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('type')->default('ventes')->change();
            $table->unsignedInteger('quantite');
            $table->decimal('prix_unitaire',10,2);
            $table->decimal('taxe', 10,2)->default(0);
            $table->string('client')->nullable(); // ou une relation avec une table clients plus tard
            $table->date('date_vente')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
