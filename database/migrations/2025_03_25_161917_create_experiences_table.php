<?php

use App\Models\Experience;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained('users')->cascadeOnDelete();
            $table->text('position');
            $table->string('company');
            $table->string('company_url')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_freelance');
            $table->text('description');
            $table->string('technologies');
            $table->string('location')->nullable();
            $table->timestamps();
        });

//        Schema::create('experience_translations', function (Blueprint $table) {
//            $table->increments('id');
//            $table->foreignIdFor(Experience::class)->constrained('experiences')->cascadeOnDelete();
//            $table->string('locale')->index();
//
//            $table->string('name');
//            $table->text('text');
//
//            $table->unique(['experience_id','locale']);
//        });
    }

    public function down()
    {
        Schema::dropIfExists('experiences');
    }
};
