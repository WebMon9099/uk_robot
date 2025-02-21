<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogcategoryController extends Controller
{
    //

    public function index()
    {
        $blogcategories = BlogCategory::all();

        return view('admin.blog.categories', compact('blogcategories'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'category' => 'required|unique:blog_categories,category|max:255',
        ]);

        if($validator->fails()){
            return response()->json(['success'=>false, 'message' => $validator->errors()->first('category')]);
        }

        try{
            $category = new BlogCategory();
            $category->category = $request->input('category');
            $category->save();

            return response()->json([
                'success' => true,
                'message' => 'Category added succes fully'
            ],200);


        }catch(\Exception $e){
            // Return error response in case of an exception
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ], 500); // 500 Internal Server Error status code
        }

    }

    public function update(Request $request, $id){

        /* echo "<pre>";
        print_r($request->all());
        echo "</pre>"; */

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:blog_categories,category,' . $id . '|max:255',
        ]);

        if($validator->fails()){
            return response()->json(['success'=>false, 'message' => $validator->errors()->first('name')]);
        }

        try{
            $category = BlogCategory::findOrFail($id);
            $category->category = $request->input('name');

            $category->save();

            return response()->json([
                'success' => true,
                'message' => 'Category updated successfully.'
            ],200);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ],500);
        }
    }

    public function destroy($id){
        try{
            $category = BlogCategory::findOrFail($id);
            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully!'
            ]);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the category. Please try again.'
            ],500);
        }
    }
}
