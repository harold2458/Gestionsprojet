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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); 
            $table->string('title'); 
            $table->text('description')->nullable(); 
            $table->enum('status', ['Non commencé', 'En cours', 'Terminé'])->default('Non commencé'); 
            $table->enum('priority', ['Basse', 'Moyenne', 'Haute'])->default('Moyenne'); 
            $table->foreignId('project_id')->constrained()->onDelete('cascade'); 
            $table->foreignId( 'assigned_to')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps(); 
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
