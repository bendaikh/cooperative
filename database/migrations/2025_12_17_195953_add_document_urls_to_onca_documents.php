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
        Schema::table('onca_documents', function (Blueprint $table) {
            // Primary document URL (from CamScanner or file upload)
            $table->text('document_url')->nullable()->after('content');
            
            // JSON array to store multiple document URLs
            $table->json('document_urls')->nullable()->after('document_url');
            
            // Document type: 'camscanner', 'upload', 'external'
            $table->string('document_source')->default('upload')->after('document_urls');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('onca_documents', function (Blueprint $table) {
            $table->dropColumn(['document_url', 'document_urls', 'document_source']);
        });
    }
};
