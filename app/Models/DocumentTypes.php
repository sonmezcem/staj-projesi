<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentTypes extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = "document_types";

    protected $fillable = [
        'document_type',
        'status'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('document_type')
            ->saveSlugsTo('document_slug');
    }

}
