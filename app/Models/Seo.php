<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seo extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $fillable = [
        'article_id',
    ];

    public $translatedAttributes = [
        'title',
        'description',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
