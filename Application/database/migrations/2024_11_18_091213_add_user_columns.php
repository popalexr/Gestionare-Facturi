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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email_verified_at');
            $table->string('avatar')->nullable()->after('phone');
            $table->string('status')->enum(['active', 'inactive'])->default('inactive')->after('avatar');
            $table->string('role')->default('user')->after('status');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('avatar');
            $table->dropColumn('status');
            $table->dropColumn('role');
            $table->dropSoftDeletes();
        });
    }
};
