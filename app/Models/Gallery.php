<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'images',
        'sequence_number',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function scopeFilter($query, $request)
    {
        return $query
            ->when($request->has('article') && $request->article !== null, fn($query) => $query->withWhereHas('article', fn($q) => $q->where('id', $request->article)));
    }

    public function getGalleryImage($image, $extension, $width = null)
    {
        if ($width == null) {
            return Storage::url('uploads/galleries/' . $this->id . '/' . $image . $extension);
        }

        return Storage::url('uploads/galleries/' . $this->id . '/' . $image . '_' . $width . '.' . $extension);
    }
}
