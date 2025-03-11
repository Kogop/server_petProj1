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
        Schema::create('user_files', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('user_id')
                    ->constrained( table: 'users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade')
                    ->comment('user id ))');
            $table->string('file_path')->comment('file path ))');
            $table->timestampTz('upload_date')->useCurrent()->comment('upload date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_files');
    }
};
