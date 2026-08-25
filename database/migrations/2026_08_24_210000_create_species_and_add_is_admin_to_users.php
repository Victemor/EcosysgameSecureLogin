<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->after('password');
        });

        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('common_name');
            $table->string('scientific_name');
            $table->string('corrected_scientific_name')->nullable();
            $table->string('group', 40)->index();
            $table->string('family')->nullable()->index();
            $table->string('conservation_status', 80)->nullable()->index();
            $table->text('ecosystem')->nullable();
            $table->string('altitudinal_range')->nullable();
            $table->longText('source')->nullable();
            $table->longText('reference')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('species');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
    }
};
