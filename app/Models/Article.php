<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    public function seo(): HasOne
    {
        return $this->hasOne(Seo::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function texts(): HasMany
    {
        return $this->hasMany(Text::class);
    }

    public function scopeFilter($query, $request)
    {
        return $query
            ->when($request->has('title') && $request->title !== null, fn($query) => $query->whereTranslationLike('title', '%'. $request->title .'%'))
            ->when($request->has('category') && $request->category !== null, fn($query) => $query->withWhereHas('category', fn($q) => $q->where('id', $request->category)))
            ->when($request->has('is_public') && $request->is_public !== null, fn($query) => $query->where('is_public', $request->is_public))
            ->when($request->has('date_from') && $request->has('date_to') && $request->date_from !== null && $request->date_to !== null, fn($query) => $query->whereBetween('articles.created_at', [$request->date_from, $request->date_to]))
            ->when($request->has('date_from') && $request->has('date_to') && $request->date_from !== null && $request->date_to === null, fn($query) => $query->whereDate('created_at', '>=', $request->date_from))
            ->when($request->has('date_from') && $request->has('date_to') && $request->date_from === null && $request->date_to !== null, fn($query) => $query->whereDate('created_at', '<=', $request->date_to));
    }

    public function isPublic(): string
    {
        return ($this->is_public == self::PUBLIC)
            ? __('messages.published')
            : __('messages.not_published');
    }

    public function getArticleMainImage($width, $extension)
    {
        if ($this->image == null) {
            return '/img/no-image.png';
        }

        if ($width == null) {
            return Storage::url('uploads/articles/' . $this->image . '.' . $extension);
        }

        return Storage::url('uploads/articles/' . $this->image . '_' . $width . '.' . $extension);
    }
}
