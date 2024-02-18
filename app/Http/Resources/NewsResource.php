<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $category = Category::where('id', $this->category_id)->first();
        $author = User::where('id', $this->user_id)->first();
        $comment = Comment::where('news_id', $this->id)->get();

        return [
            'id'        => $this->id,
            'news_content' => $this->news_content,
            'category'  => $category->category_name,
            'author'      => $author->name,
            'comennt'     => $comment
        ];
        // return parent::toArray($request);
    }
}
