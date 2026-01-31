<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(){
Schema::create('sites', function (Blueprint $table) {
$table->id();
$table->string('name');
$table->string('logo');
$table->string('url');
$table->string('rate');
$table->string('category');
$table->timestamps();
});
}


public function down(){
Schema::dropIfExists('sites');
}
};