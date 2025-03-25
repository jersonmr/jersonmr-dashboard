<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('language_code', 5)->unique();
            $table->string('locale_code', 5)->unique();
            $table->boolean('active')->default(false);
            $table->boolean('is_default')->default(false);
        });

        \Illuminate\Support\Facades\DB::table('languages')->insert([
            \App\Models\Language::SPANISH,
            \App\Models\Language::ENGLISH,
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('languages');
    }
};
