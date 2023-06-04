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
        Schema::create('room_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("room_id")->nullable()->index();
            $table->unsignedBigInteger("guest_id")->nullable()->index();
            $table->double("price", 15, 2)->default(0.00);
            $table->tinyInteger("no_of_guest")->default(1);
            $table->dateTime("start_date");
            $table->dateTime("end_date");
            $table->timestamps();
            $table->foreign("room_id")->on("rooms")->references("id")->onDelete("SET NULL")->onUpdate("CASCADE"); 
            $table->foreign("guest_id")->on("users")->references("id")->onDelete("SET NULL")->onUpdate("CASCADE"); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_bookings');
    }
};
