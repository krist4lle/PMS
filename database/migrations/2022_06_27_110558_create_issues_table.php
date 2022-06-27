<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->timestamps();
            $table->timestamp('finished_at')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->integer('estimate')->nullable();
            $table->foreignId('issue_status_id')->constrained()->restrictOnDelete();
            $table->foreignId('project_id')->constrained();
            $table->foreignId('assignee_id')->constrained('users')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
};
