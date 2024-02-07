<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    const PUBLIC = 1;
    const NOT_PUBLIC = 0;

    protected $fillable = [
        'slug',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public $translatedAttributes = [
        'title',
    ];

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
}
