<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meta_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('taggable_id');
            $table->string('taggable_type');

            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->text('canonical')->nullable();
            $table->boolean('noindex')->default(false);

            $table->string('og_title', 255)->nullable();
            $table->text('og_description')->nullable();
            $table->text('og_image')->nullable();
            $table->text('og_type')->nullable();
            $table->text('og_site_name')->nullable();

            $table->timestamps();

            $table->index(['taggable_id', 'taggable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_tags');
    }
};
