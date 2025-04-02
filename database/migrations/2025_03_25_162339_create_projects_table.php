<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained('users');
            $table->boolean('is_active')->default(true);
            $table->text('title');
            $table->text('description');
            $table->string('url');
            $table->string('technologies');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });

//        Schema::create('project_translations', function (Blueprint $table) {
//            $table->increments('id');
//            $table->foreignIdFor(\App\Models\Project::class)->constrained('projects')->cascadeOnDelete();
//            $table->string('locale')->index();
//
//            $table->string('name');
//            $table->text('text');
//
//            $table->unique(['project_id','locale']);
//        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
