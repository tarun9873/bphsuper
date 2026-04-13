// database/migrations/2024_01_01_000000_create_notes_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('share_id', 20)->unique();
            $table->string('title', 255)->default('New Note');
            $table->longText('content')->nullable();
            $table->timestamps();
            
            $table->index('share_id');
            $table->index('updated_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notes');
    }
}