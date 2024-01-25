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

            $table->json('seo')->default(json_encode([
                'title' => null,
                'description' => null,
                'keywords' => null,
                'canonical' => null,
                'noindex' => false,
            ]));

            $table->json('og')->default(json_encode([
                'title' => null,
                'description' => null,
                'image' => null,
                'type' => null,
                'site_name' => null,
            ]));

            $table->timestamps();
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
