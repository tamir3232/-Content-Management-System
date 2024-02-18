<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'comment';
    protected $fillable = [
        'name',
        'comment',
        'user_id',
        'news_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function News()
    {
        return $this->belongsTo(News::class, 'category_id');
    }
}
