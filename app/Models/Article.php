<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Article extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    const PUBLIC = 1;
    const NOT_PUBLIC = 0;

    protected $fillable = [
        'category_id',
        'slug',
        'image',
        'publish_date',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'publish_date' => 'date',
    ];

    public $translatedAttributes = [
        'title',
        'subtitle',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, $request)
    {
        return $query
            ->when($request->has('title') && $request->title !== null, fn($query) => $query->whereTranslationLike('title', '%'. $request->title .'%'))
            ->when($request->has('is_public') && $request->is_public !== null, fn($query) => $query->where('is_public', $request->is_public));
    }

    public function isPublic(): string
    {
        return ($this->is_public == self::PUBLIC)
            ? __('messages.published')
            : __('messages.not_published');
    }

    public function getArticleImage()
    {
        if (is_null($this->image)) {
            return '/img/no-image.png';
        }
        return Storage::url('uploads/articles/' . $this->image);
    }
}
