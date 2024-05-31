<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryCotroller extends Controller
{
    public function AllSubCategories(){
        $subcategories = SubCategory::latest()->get();
        return view('backend.subcategory.subcategory_all',compact('subcategories'));
    }

    public function AddSubCategory(){

        $categories = Category::orderBy('category_name','ASC')->get();
      return view('backend.subcategory.subcategory_add',compact('categories'));

    }

    public function StoreSubCategory(Request $request){ 

        SubCategory::create([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-',$request->subcategory_name)), 
        ]);

       $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategories')->with($notification); 

    }

    public function EditSubCategory(Request $request){

        $categories = Category::orderBy('category_name','ASC')->get();
        $subcategory = SubCategory::findOrFail($request->id);
        return view('backend.subcategory.subcategory_edit',compact('categories','subcategory'));
  
      }
  
      public function UpdateSubCategory(Request $request){
  
          $subcat_id = $request->id;
  
           SubCategory::findOrFail($subcat_id)->update([
              'category_id' => $request->category_id,
              'subcategory_name' => $request->subcategory_name,
              'subcategory_slug' => strtolower(str_replace(' ', '-',$request->subcategory_name)), 
          ]);
  
         $notification = array(
              'message' => 'SubCategory Updated Successfully',
              'alert-type' => 'success'
          );
  
          return redirect()->route('all.subcategories')->with($notification); 
  
  
      }
  
  
      public function RemoveSubCategory(Request $request){
  
          SubCategory::findOrFail($request->id)->delete();
  
           $notification = array(
              'message' => 'SubCategory Deleted Successfully',
              'alert-type' => 'success'
          );
  
          return redirect()->back()->with($notification); 
  
  
      }

      public function GetSubCategory($category_id){
        $subcategory = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
            return json_encode($subcategory);

    }
}
