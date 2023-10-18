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
        Schema::create('abstrak_papers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('abstrak_id');
            $table->string('paper_file');
            $table->string('presentation_file');
            $table->enum('status',['pending','send','accepted','rejected']);
            $table->text('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('abstrak_id')->references('id')->on('abstraks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abstrak_papers');
    }
};
