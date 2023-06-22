<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    //
    public function getItems(Request $request){


        try {
        // Code that may throw an exception

        // Example: Access an undefined variable to trigger an exception

        $items=Item::join('categories','categories.id','=','category_id')->join('users','users.id','user_id')->select('items.*','categories.category_name','categories.id as categoryId','categories.category_image','users.name')->get()->toArray();
        // dd($items);
        $categories=Category::get()->toArray();
            $modifiedCategories = array_map(function ($category) {

              if (!str_starts_with($category['category_image'], 'http')) {
              $category['category_image'] = asset('storage/' . $category['category_image']);
              }
    return $category;
}, $categories);



        $modifiedData = array_map(function ($product) {
    if (!str_starts_with($product['image'], 'http')) {
        $product['image'] = asset('storage/' . $product['image']);
    }
    if (!str_starts_with($product['category_image'], 'http')) {
        $product['category_image'] = asset('storage/' . $product['category_image']);
    }
    return $product;
}, $items);


        // Log the modified data
        logger($modifiedData);
        return response()->json([
                "data"=>$modifiedData,
                "category"=>$modifiedCategories
        ],200);
    } catch (\Exception $e) {
        // Exception handling

        // Example: Log the exception
        \Log::error($e->getMessage());

        // Example: Return a response for the error
        return response()->json(['message' => 'An error occurred'], 500);
    }
    }
    // get item detail
    public function getItemDetail($id){

            $item = Item::where('items.id', $id)
    ->join('users', 'users.id', '=', 'items.user_id')
    ->select('users.name as username','items.*')
    ->get()
    ->toArray();

    Item::where('items.id',$id)->first()->increment('view_count');
    $modifiedData = array_map(function ($product) {
    if (!str_starts_with($product['image'], 'http')) {
        $product['image'] = asset('storage/' . $product['image']);
    }

                return $product;
        }, $item);

            return response()->json([
                "data"=>$modifiedData
            ]);
    }
    public function  getItemsByCategory($id){
        $items=Item::where('category_id',$id)->get()->toArray();
    $itemConditions = Item::distinct('item_condition')->pluck('item_condition');
    $itemTypes = Item::distinct('item_type')->pluck('item_type');
    $status = Item::distinct('status')->pluck('status');
        $categories=Category::get()->toArray();

            $modifiedCategories = array_map(function ($category) {

              if (!str_starts_with($category['category_image'], 'http')) {
              $category['category_image'] = asset('storage/' . $category['category_image']);
              }
         return $category;
        }, $categories);


        $modifiedData = array_map(function ($product) {
           if (!str_starts_with($product['image'], 'http')) {
           $product['image'] = asset('storage/' . $product['image']);
        }

                return $product;
         }, $items);
        //
            return response()->json([
                "data"=>$modifiedData,
                "category"=>$modifiedCategories,
                'itemConditions'=>$itemConditions,
                "itemTypes"=>$itemTypes,
                "status"=>$status
              ],200);

    }
    // filter
    public function filterProducts(Request $request){
        $query = Item::query();

    if ($request->has('item_name')) {
           $query->where('item_name','like','%'.$request->input('item_name').'%');
    }

    if ($request->has('price_min')) {
        $query->where('price', '>=', $request->input('price_min'));
    }

    if ($request->has('price_max')) {
        $query->where('price', '<=', $request->input('price_max'));
    }

    if ($request->has('item_condition')) {
        $query->where('item_condition', $request->input('item_condition'));
    }

    if ($request->has('type')) {
        $query->where('item_type', $request->input('type'));
    }

    if ($request->has('category')) {
        $query->where('category_id', $request->input('category'));
    }

        $filteredItems = $query->get();
       $modifiedData = array_map(function ($product) {
           if (!str_starts_with($product['image'], 'http')) {
           $product['image'] = asset('storage/' . $product['image']);
        }

                return $product;
         }, $filteredItems->toArray());


         return response()->json([
            "message"=>"succesw",
            "data"=>$modifiedData
        ]);
    }
    // search item
 public function searchItems(Request $request)
{
    if ($request->has('product_name')) {
        $query = Item::query()->where('item_name','like','%'.$request->input('product_name').'%');
        $filteredItems = $query->get()->toArray();

        // $filteredItems=$filteredItems->toArray();
          $modifiedData = array_map(function ($product) {
           if (!str_starts_with($product['image'], 'http')) {
           $product['image'] = asset('storage/' . $product['image']);
        }

                return $product;
         }, $filteredItems);

        return response()->json([
            "message" => "Success searching",
            "data" => $modifiedData
        ]);
    } else if ($request->has('category_name')) {
        $categoryItems = Item::join('categories', 'categories.id', 'items.category_id')
            ->where('categories.category_name', $request->input('category_name'))
            ->select('items.*', 'categories.category_name')
            ->get()->toArray();

      $modifiedData = array_map(function ($product) {
           if (!str_starts_with($product['image'], 'http')) {
           $product['image'] = asset('storage/' . $product['image']);
        }

                return $product;
         }, $categoryItems);

         return response()->json([
            "message" => "Success searching",
            "data" => $modifiedData
        ]);
    } else {
        return response()->json([
            "message" => "No search criteria provided"
        ]);
    }
    }
    // update view count
    public function updateViews($id){
        logger($id);
    }


}
