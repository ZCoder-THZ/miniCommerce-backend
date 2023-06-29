<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Item;
use App\Models\Category;
use App\Models\ItemType;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ItemCondition;
use App\Models\ItemTypeConditions;
use Illuminate\Support\Facades\Validator;


class ItemController extends Controller
{
    //get itemlist
    public function getItemList (Request $request){
        // dd(Item::get());
        $pagination = $request->limit ?? 5;
        $items=Item::join('categories','categories.id','=','category_id')
        ->join('users','users.id','=','user_id')
        ->select('items.*','categories.category_name as category_name',
        'users.name')->paginate($pagination);

        return view('itemList',compact('items'));
    }
    // create item
    public function createItemPage(Request $request){
       $categories = Category::get();
        $itemConditions=ItemCondition::get();
        $itemTypes=ItemType::get();
    $status = Item::distinct('status')->pluck('status');

        return view('createItem',compact('categories','itemConditions','itemTypes','status'));

    }
    public function createItem(Request $request){
        Validator::make($request->all(),[
            'name' => 'required|string',
    'category' => 'required|string',
    'price' => 'required|numeric',
    'description' => 'required|string',
    'itemCondition' => 'required|in:second,used,new',
    'itemType' => 'required|in:sell,buy,exchanged',
    // 'status' => 'required|in:avail,unavail',
//    'image' => 'required|image|mimes:jpeg,png',
    'uploader' => 'required|string',

    'phone' => 'required',
    'address' => 'required|string',
    'user_id' => 'required|numeric',
    'ltd' => 'required|numeric',
    'lng' => 'required|numeric'])->validate();

    //  data
        $data = [
    'item_name' => $request->input('name'),
    'category_id' => $request->input('category'),
    'price' => $request->input('price'),
    'description' => $request->input('description'),
    'item_condition' => $request->input('itemCondition'),
    'item_type' => $request->input('itemType'),
     'status' => $request->input('status') ?? 'unavail',


    'uploader' => $request->input('uploader'),
    'phone' => $request->input('phone'),
    'address' => $request->input('address'),
    'user_id' => $request->input('user_id'),
    'ltd' => $request->input('ltd'),
    'lng' => $request->input('lng')
];
    // dd($data);
          $imageName=uniqid().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/',$imageName);
            $data['image']=$imageName;
            Item::create($data);
            return redirect()->route('itemList');

}

public function getItemLimit(Request $request)
{
    $limit = $request->limit;

      $items=Item::join('categories','categories.id','=','category_id')
        ->join('users','users.id','=','user_id')
        ->select('items.*','categories.category_name as category_name',
        'users.name')->paginate($limit);
    $view = view('partials.items_table', compact('items'))->render();
    $pagination = $items->links()->render();

    if ($request->ajax()) {
        return response()->json(['data' => $view, 'links' => $pagination]);
    }
    logger($pagination);
    return view('itemList', compact('items'));
}
// delete item
    public function deleteItem($id){

        try {
             $deletedItem= Item::where('id',$id)->delete();

        $pagination = $request->limit ?? 5;
        $items=Item::join('categories','categories.id','=','category_id')
        ->join('users','users.id','=','user_id')
        ->select('items.*','categories.category_name as category_name',
        'users.name')->paginate($pagination);

        return view('itemList',compact('items'));
        } catch (\Throwable $th) {
            //throw $th;

        }

    }
// edit item
    public function editPage($id){


        $item=Item::where('id',$id)->get()[0];
        $itemConditions=ItemCondition::get();
        $itemTypes=ItemType::get();
        $categories=Category::get();
          $status = Item::distinct('status')->pluck('status');
        // dd($item->item_name);
        // dd($itemTypes,$itemConditions);
        return view('itemEditPage',compact('item','itemTypes','itemConditions','categories','status'));
        //code...

        //throw $th;




    }
    //
    public function editItem(Request $request,$id){


        // $data=$this->requestProductInfo($request);
        // return view('admin.product.update',compact('pizza','categories'));
                $data = [
    'item_name' => $request->input('name'),
    'category_id' => $request->input('category'),
    'price' => $request->input('price'),
    'description' => $request->input('description'),
    'item_condition' => $request->input('itemCondition'),
    'item_type' => $request->input('itemType'),
    'status' => $request->input('status') ?? 'unavail',

    'uploader' => $request->input('uploader'),
    'phone' => $request->input('phone'),
    'address' => $request->input('address'),
    'user_id' => $request->input('user_id'),
    'ltd' => $request->input('ltd'),
    'lng' => $request->input('lng')
];




        if($request->hasFile('image')){
            $oldImageName=Item::where('id',$id)->first();
            $oldImageName=$oldImageName->image;

            if($oldImageName !== null){
                Storage::delete('public/'.$oldImageName);
            }

            $fileName=uniqid().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;
        }
   
        Item::where('id',$id)->update($data);
        return redirect()->route('itemList');

    }
    // edit page

    // update status
        public function updateStatus(Request $request, $id)
    {
       $item = Item::find($id);
        if($item){

           $item->status=$request->status;
           $item->save();
        }
    }

}
