<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function CategoryListPage(){
        return view('category.CategoryListPage');
    }

    public function CategoryList(Request $request){
        $user_id = Auth::user()->id;
        $categories = Category::where('user_id', $user_id)->get();
        return response()->json($categories,200);
    }

    public function apiGetCategory(){
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    public function CategoryShow($id){

    }

    public function CategoryCreate(Request $request){
        $request->validate([
            'name'=>'required|unique:categories|max:150'
        ]);

        $user_id = Auth::user()->id;

        $category = Category::create([
            'name'=>$request->name,
            'user_id'=>$user_id
        ]);
        return response()->json([
            'status'=>'success',
            'message'=>'Category added successfully'
        ], 200);
    }

    public function CategoryUpdate(Request $request, $id){

    }

    public function CategoryDelete(Request $request, $id){

    }
}
