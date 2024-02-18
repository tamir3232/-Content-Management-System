<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function show($id)
    {
        $CommentExist = Comment::where('news_id', $id)->get();

        if ($CommentExist) {
            return response()->json([
                'success' => true,
                'message' => 'Comment',
                'Categories' => $CommentExist,

            ], 200);
        }
    }
    public function store(Request $request)
    {

        $request->validate([
            'news_id' => 'required',
            'name'  => 'required',
            'comment' => 'required'
        ]);

        $CommenCreate = Comment::create([
            'name' => $request->name,
            'news_id' => $request->news_id,
            'comment' => $request->comment
        ]);

        if ($CommenCreate) {
            return response()->json([
                'success' => true,
                'message' => 'Comment',
                'Comment' => $CommenCreate,

            ], 200);
        }
    }
}
