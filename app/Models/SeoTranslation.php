<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoTranslation extends Model
{
    use HasFactory;

    protected $table = 'seo_translations';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
    ];
}
