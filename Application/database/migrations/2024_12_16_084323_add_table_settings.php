<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableSettings extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id(); // ID (PK)
            $table->string('key', 255)->unique(); // Key
            $table->string('value', 255); // Value
            $table->enum('type', ['int', 'string', 'json']); // Type (enum)
            $table->timestamps(); // Timestamps (optional)
            Schema::rename('add_table_settings', 'settings');
        });
    }

    public function down()
    {
        Schema::dropIfExists('add_table_settings');
    }
}
