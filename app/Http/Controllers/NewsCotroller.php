<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NewsCotroller extends Controller
{
    public function index()
    {
        $newsExist = News::where('user_id', Auth::user()->id)->get();

        if ($newsExist) {
            return response()->json([
                'success' => true,
                'message' => 'MyNews',
                'Categories' => NewsResource::collection($newsExist),

            ], 200);
        }
    }

    public function show($id)
    {
        $newsExist = News::where('user_id', Auth::user()->id)->where('id', $id)->get();

        if ($newsExist) {
            return response()->json([
                'success' => true,
                'message' => 'MyNews',
                'Categories' => NewsResource::collection($newsExist),

            ], 200);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'news_content' => 'required',
            'category_id' => ' required',

        ]);

        $addNews = News::create([
            'news_content' => $request->news_content,
            'category_id'  => $request->category_id,
            'user_id'   => Auth::user()->id,
        ]);


        return response()->json([
            'message' => 'News Created',
            'Categories' => $addNews,

        ], 201);
    }

    public function update($id, Request $request)
    {
        $newsExist = News::where('id', $id)->first();
        if ($newsExist) {

            if ($newsExist->user_id == Auth::user()->id) {
                $newsExist->update([
                    'news_content' => $request->news_content ?? $newsExist->news_content,
                    'category_id'  => $request->category_id ?? $newsExist->category_id,
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'News Updated',
                    'Categories' => NewsResource::collection($newsExist),

                ], 200);
            } else {
                return response()->json([
                    'success' => False,
                    'message' => 'you dont have access to news update',
                ], 404);
            }
        }
        return response()->json([
            'message' => 'News not exist',

        ], 404);
    }

    public function destroy($id)
    {
        $newsExist = News::where('id', $id)->first();
        if ($newsExist) {

            if ($newsExist->user_id == Auth::user()->id) {
                $newsExist->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'News Deleted',
                ], 200);
            } else {
                return response()->json([
                    'success' => False,
                    'message' => 'you dont have access to news delete',
                ], 405);
            }
        }
        return response()->json([
            'message' => 'News not exist',
        ], 200);
    }

    public function AllNews()
    {
        $newsExist = News::get();

        if ($newsExist) {
            return response()->json([
                'success' => true,
                'message' => 'All News',
                'News' => NewsResource::collection($newsExist),

            ], 200);
        }
    }

    public function ShowNews($id)
    {
        $newsExist = News::where('id', $id)->get();

        if ($newsExist) {
            return response()->json([
                'success' => true,
                'message' => 'MyNews',
                'Categories' => NewsResource::collection($newsExist),

            ], 200);
        }
    }
}
