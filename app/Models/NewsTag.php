<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsTag extends Model
{
    use HasFactory;

    protected $table = 'news_tags';

    protected $guarded = [];

    public function news(): HasMany
    {
        return $this->hasMany(News::class,'id','news_id');
    }
}
