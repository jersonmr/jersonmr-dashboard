<?php

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained('users');
            $table->foreignIdFor(Client::class)->constrained('clients');
            $table->string('number');
            $table->date('date');
            $table->string('status')->default(\App\Enums\InvoiceStatusEnum::DRAFT->value);
            $table->decimal('total_amount');
            $table->string('currency')->default(\App\Enums\CurrencyEnum::DOLLAR->value);
            $table->text('notes');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
