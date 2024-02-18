<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoriesController extends Controller
{
    public function index()
    {
        $categoryExist = category::get();

        return response()->json([
            'success' => true,
            'message' => 'All Categories',
            'Categories' => $categoryExist,

        ], 200);
    }

    public function show($id)
    {
        $categoryExist = category::where('id', $id)->first();
        if ($categoryExist) {
            return response()->json([
                'success' => true,
                'message' => 'Category',
                'Categories' => $categoryExist,

            ], 200);
        }
        return response()->json([
            'message' => 'Categories not exist',

        ], 404);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);


        $categoryExist = category::where('category_name', $request->name)->first();
        if ($categoryExist) {
            return response()->json([
                'message' => 'Categories already exist',
                'Categories' => $categoryExist,

            ], 405);
        }

        $addCategory = Category::create(['category_name' => $request->name]);

        return response()->json([
            'message' => 'Category Created',
            'Categories' => $addCategory,

        ], 201);
    }

    public function update($id, Request $request)
    {
        $categoryExist = category::where('id', $id)->first();
        if ($categoryExist) {

            $categoryExist->update([
                'category_name' => $request->name ?? $categoryExist->category_name
            ]);



            return response()->json([
                'success' => true,
                'message' => 'Category',
                'Categories' => $categoryExist,

            ], 200);
        }
        return response()->json([
            'message' => 'Categories not exist',

        ], 404);
    }

    public function destroy($id)
    {
        $categoryExist = category::where('id', $id)->first();
        if ($categoryExist) {
            $categoryExist->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category Deleted',
            ], 200);
        }
        return response()->json([
            'message' => 'Categories not exist',

        ], 404);
    }
}
