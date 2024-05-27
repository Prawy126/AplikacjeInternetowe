<?php

use App\Models\Account;
use App\Models\History;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name', 30);
            $table->string('brand', 30);
            $table->integer('year');
            $table->integer('mileage');
            $table->text('description')->nullable();
            $table->timestamp('end_date');
            $table->boolean('is_end');
            $table->decimal('min_price', 10, 2);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
