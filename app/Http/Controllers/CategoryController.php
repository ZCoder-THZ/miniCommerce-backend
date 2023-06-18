<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    //
    public function getCategoryList(Request $request){

        $categories=Category::paginate();

        return view('categoryList',compact('categories'));

    }
    // create category
    public function createPage(Request $request){

        return view('createCategory');
    }

    //
    public function createCategory(Request $request){
       Validator::make($request->all(),[
            'categoryName'=>"required|string",
            'status'=>"required|in:publish,hidden",
            'image' => 'required|image|mimes:jpeg,png',


        ])->validate();

        $data=[
            "category_name"=>$request->input('categoryName'),
            "status"=>$request->input('status')

        ];
         $imageName=uniqid().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/',$imageName);
            $data['category_image']=$imageName;

            Category::create($data);

        $categories=Category::paginate(10);

        return view('categoryList',compact('categories'));
    }
      public function editCategoryPage($id){
        $category=Category::where('id',$id)->first();

        if($category){
            return view('editCategory',compact('category'));

        }else{

            dd('doest exist');
        }
    }
    public function editCategory(Request $request,$id){
         $category=Category::where('id',$id)->first();

        if($category){
              $data=[
            "category_name"=>$request->input('categoryName'),
            "status"=>$request->input   ('status')

                ];
        if($request->hasFile('category_image')){

            $oldImageName=$category->category_image;

            if($oldImageName !== null){
                Storage::delete('public/'.$oldImageName);
            }

            $fileName=uniqid().'_'.$request->file('category_image')->getClientOriginalName();
            $request->file('category_image')->storeAs('public',$fileName);
            $data['image']=$fileName;
               }

        Category::where('id',$id)->update($data);
            $categories=Category::paginate();


        return view('categoryList',compact('categories'));
        }else{

            dd('doest exist');
        }


    }
    public function deleteCategory($id){

        try {
        Category::where('id',$id)->delete();
             $categories=Category::paginate();


        return view('categoryList',compact('categories'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}

