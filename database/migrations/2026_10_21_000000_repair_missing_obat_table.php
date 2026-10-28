<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('obat')) {
            Schema::create('obat', function (Blueprint $table) {
                $table->id();
                $table->string('nama_obat');
                $table->string('kemasan', 35)->nullable();
                $table->integer('harga');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        // Keep the table: it may have existed before this repair migration ran.
    }
};
