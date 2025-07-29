<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
	
	public function up(): void
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->json('embedding')->nullable(); // stores vector
			$table->timestamps();
		});
	}
	
	public function down()
    {
        Schema::dropIfExists('categories');
    }
}
