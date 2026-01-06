<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OncaDocument extends Model
{
    protected $fillable = [
        'type',
        'reference',
        'title',
        'version',
        'date',
        'responsible',
        'content',
        'document_url',
        'document_urls',
        'document_source',
    ];

    protected $casts = [
        'content' => 'array',
        'document_urls' => 'array',
        'date' => 'date',
    ];

    /**
     * Get the primary document URL
     */
    public function getDocumentUrlAttribute($value)
    {
        return $value;
    }

    /**
     * Get all document URLs (merged from both single and multiple URLs)
     */
    public function getAllDocumentUrls()
    {
        $urls = [];
        
        // Add primary URL if exists
        if ($this->document_url) {
            $urls[] = $this->document_url;
        }
        
        // Add all URLs from array
        if ($this->document_urls && is_array($this->document_urls)) {
            $urls = array_merge($urls, $this->document_urls);
        }
        
        return array_filter(array_unique($urls));
    }

    /**
     * Check if this is a CamScanner document
     */
    public function isCamScannerDocument()
    {
        return $this->document_source === 'camscanner';
    }

    /**
     * Check if has any documents
     */
    public function hasDocuments()
    {
        return !empty($this->document_url) || !empty($this->document_urls);
    }
}
