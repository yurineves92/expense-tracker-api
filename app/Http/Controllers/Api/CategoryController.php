<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', '=', Auth::user()->id)->get();

        return response()->json(
            [
                "data" => [
                    "categories" => $categories,
                ],
            ],
            200
        );
    }

    public function show($id)
    {
        return response()->json(
            [
                "data" => [
                    'category' => Category::find($id)
                ]
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'user_id' => 'required',
        ]);
        
        $category = Category::create($request->all());

        return response()->json(
            [
                "data" => [
                    "message" => 'Category created successfully.',
                    'category' => $category
                ]
            ],
            201
        );
    }

    public function update(Request $request, $id)
    {
        $category = Category::where('user_id', '=', Auth::user()->id)->where('id', '=', $id)->first();
        if(empty($category)) {
            return response()->json(
                [
                    "data" => [
                        "message" => "Category not found.",
                    ],
                ],
                200
            );
        }

        $category->name = $request->name;
        $category->user_id = Auth::user()->id;
        $category->update();

        return response()->json(
            [
                "data" => [
                    "message" => 'Category updated successfully.',
                    'category' => $category
                ]
            ],
            201
        );
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        
        return response()->json(
            [
                "data" => [
                    "message" => 'Category removed successfully.'
                ]
            ],
            200
        );
    }
}
