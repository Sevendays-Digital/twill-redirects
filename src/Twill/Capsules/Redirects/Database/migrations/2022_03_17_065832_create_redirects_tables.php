<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TwillRedirects\Enums\RedirectTypes;

class CreateRedirectsTables extends Migration
{
    public function up(): void
    {
        Schema::create('redirects', function (Blueprint $table) {
            createDefaultTableFields($table);

            $table->timestamp('publish_start_date')->nullable();
            $table->timestamp('publish_end_date')->nullable();

            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();

            $table->string('redirect_type')->default(RedirectTypes::INTERNAL);

            $table->text('from')->nullable();
            $table->text('to')->nullable();
            $table->text('to_external')->nullable();

            $table->nullableMorphs('redirectable');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('redirects');
    }
}
