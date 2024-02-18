<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPages extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'custom_page';
    protected $fillable = [
        'custom_url',
        'page_content',
        'user_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
