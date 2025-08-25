<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property', function (Blueprint $table) {
            if (!Schema::hasColumn('property', 'approval_status')) {
                $table->string('approval_status', 20)->default('pending')->after('status');
            }
            if (!Schema::hasColumn('property', 'rejection_reason')) {
                $table->text('rejection_reason')->nullable()->after('approval_status');
            }
            if (!Schema::hasColumn('property', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('rejection_reason');
            }
        });
    }

    public function down(): void
    {
        Schema::table('property', function (Blueprint $table) {
            if (Schema::hasColumn('property', 'approved_at')) {
                $table->dropColumn('approved_at');
            }
            if (Schema::hasColumn('property', 'rejection_reason')) {
                $table->dropColumn('rejection_reason');
            }
            if (Schema::hasColumn('property', 'approval_status')) {
                $table->dropColumn('approval_status');
            }
        });
    }
};
