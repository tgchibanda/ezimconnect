<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\ImageFileSizesHelper;

class CategoryCotroller extends Controller
{
    public function AllCategory()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_all', compact('categories'));
    }

    public function AddCategory()
    {
        return view('backend.category.category_add');
    }

    public function StoreCategory(Request $request)
    {
        $save_url = ImageFileSizesHelper::CategoryResizeImage($request->file('category_image'));
        Category::create([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'category_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.categories')->with($notification);
    }

    public function EditCategory(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function UpdateCategory(Request $request)
    {

        $category_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('category_image')) {

            $save_url = ImageFileSizesHelper::CategoryResizeImage($request->file('category_image'));

                unlink($old_img);
        

                Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'category_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Category Updated with image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.categories')->with($notification);
        } else {

            Category::find($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            ]);

            $notification = array(
                'message' => 'Category Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.categories')->with($notification);
        } // end else

    }

    public function RemoveCategory(Request $request){

        $category = Category::findOrFail($request->id);
        $img = $category->category_image;
        unlink($img ); 

        $category->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.categories')->with($notification); 

    }
}
