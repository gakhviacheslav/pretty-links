<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('original_link');
            $table->string('token')->unique();
            $table->integer('views')->default(0);
            $table->integer('max_views')->default(0);
//            $table->timestamps('expired_at')->default(DB::raw('NOW() + INTERVAL 24 HOUR'));
            $table->timestamp('expired_at')->nullable()->default(date('Y-m-d H:i:s', strtotime('+24 hours')));
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
