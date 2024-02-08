<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model
{
    use HasFactory;

    protected $table = 'article_translations';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'subtitle',
    ];
}
