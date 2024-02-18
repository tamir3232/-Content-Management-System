<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'news';
    protected $fillable = [
        'category_id',
        'news_content',
        'user_id',
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
