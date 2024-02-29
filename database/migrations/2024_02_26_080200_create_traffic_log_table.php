<?php

use App\Services\TrafficLightStateMachine\Enums\StateMachineContextEnum;
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
        Schema::create('traffic_log', function (Blueprint $table) {
            $table->engine('MyISAM');
            $table->id();
            $table->text('message');
            $table->enum('state', StateMachineContextEnum::values());
            $table->timestamp('created_at')->useCurrent();
            $table->index(['created_at', 'state']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traffic_log');
    }
};
