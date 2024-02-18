<?php

namespace App\Http\Controllers;

use App\Models\CustomPages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomPageController extends Controller
{
    public function index()
    {
        $customPageExist = CustomPages::where('user_id', Auth::user()->id)->get();

        if ($customPageExist) {
            return response()->json([
                'success' => true,
                'message' => 'Custom Page',
                'Categories' => $customPageExist,

            ], 200);
        }
    }

    public function show($id)
    {
        $customPageExist = CustomPages::where('user_id', Auth::user()->id)->where('id', $id)->get();

        if ($customPageExist) {
            return response()->json([
                'success' => true,
                'message' => 'Custom Pages',
                'Categories' => $customPageExist,

            ], 200);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'custom_url' => 'required',
            'page_content' => ' required',

        ]);

        $addCustomPages = CustomPages::create([
            'custom_url' => $request->custom_url,
            'page_content'  => $request->page_content,
            'user_id'   => Auth::user()->id,
        ]);


        return response()->json([
            'message' => 'Custom Page Created',
            'Categories' => $addCustomPages,

        ], 201);
    }

    public function update($id, Request $request)
    {
        $customPageExist = CustomPages::where('id', $id)->first();
        if ($customPageExist) {

            if ($customPageExist->user_id == Auth::user()->id) {
                $customPageExist->update([
                    'custom_url' => $request->custom_url ?? $customPageExist->custom_url,
                    'page_content'  => $request->page_content ?? $customPageExist->page_content,
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Custom Page Updated',
                    'Categories' => $customPageExist,

                ], 200);
            } else {
                return response()->json([
                    'success' => False,
                    'message' => 'you dont have access to Custom Page update',
                ], 405);
            }
        }
        return response()->json([
            'message' => 'Custom Page not exist',

        ], 404);
    }

    public function destroy($id)
    {
        $customPageExist = CustomPages::where('id', $id)->first();
        if ($customPageExist) {

            if ($customPageExist->user_id == Auth::user()->id) {
                $customPageExist->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Custom Page Deleted',
                ], 200);
            } else {
                return response()->json([
                    'success' => False,
                    'message' => 'you dont have access to Custom Page delete',
                ], 405);
            }
        }
        return response()->json([
            'message' => 'Custom Page not exist',
        ], 404);
    }
}
