<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextTranslation extends Model
{
    use HasFactory;

    protected $table = 'text_translations';

    public $timestamps = false;

    protected $fillable = [
        'content',
    ];
}
