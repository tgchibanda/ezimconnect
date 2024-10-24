<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use Carbon\Carbon;
use App\Helpers\ImageFileSizesHelper;
use App\Helpers\ProfileHelper;
use App\Models\MultiImg;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function AllProducts()
    {
        $user = ProfileHelper::GetAuthUserData();
        $role = $user->role;
        $id = $user->id;

        if ($role == 'vendor') {
            $products = Product::where('vendor_id', $id)->latest()->get();
        } else {
            $products = Product::latest()->get();
        }

        return view('backend.product.all_products', compact('products', 'role'));
    }

    public function AddProduct()
    {
        $userData = ProfileHelper::GetAuthUserData();
        $activeVendors = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.product.add_product', compact('brands', 'categories', 'activeVendors', 'userData'));
    }

    private function storeBase64($imageBase64)
    {
        list($type, $imageBase64) = explode(';', $imageBase64);
        list(, $imageBase64)      = explode(',', $imageBase64);
        $imageBase64 = base64_decode($imageBase64);
        $imageName = time() . '.png';
        $path = public_path() . "/upload/products/thumbnail/" . $imageName;

        file_put_contents($path, $imageBase64);

        return "/upload/products/thumbnail/" .$imageName;
    }

    private function storeGalleryBase64($imageBase64)
{
    // Explode and decode the base64 image string
    list($type, $imageBase64) = explode(';', $imageBase64);
    list(, $imageBase64)      = explode(',', $imageBase64);
    $imageBase64 = base64_decode($imageBase64);

    // Generate a unique image name using time() and uniqid()
    $imageName = time() . '_' . uniqid() . '.png';
    
    // Define the path where the image will be stored
    $path = public_path() . "/upload/products/multi-image/" . $imageName;

    // Save the decoded image data to the file
    file_put_contents($path, $imageBase64);

    // Return the path of the saved image
    return "/upload/products/multi-image/" . $imageName;
}

    public function StoreProduct(Request $request)
    {

        DB::beginTransaction();
        try {

            
            $product_id = Product::insertGetId([

                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),

                'product_code' => $request->product_code,
                'product_qty' => $request->product_qty,
                'product_tags' => $request->product_tags,
                'product_size' => $request->product_size,
                'product_color' => $request->product_color,

                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,

                'hot_deals' => $request->hot_deals,
                'featured' => $request->featured,
                'special_offer' => $request->special_offer,
                'special_deals' => $request->special_deals,

                'product_thumbnail' => $this->storeBase64($request->image_base64),
                'vendor_id' => $request->vendor_id,
                'status' => 1,
                'created_at' => Carbon::now(),

            ]);

            /// Multiple Image Upload From here //////

            $galleries = ['gallery_image1_base64', 'gallery_image2_base64', 'gallery_image3_base64', 'gallery_image4_base64'];

                foreach ($galleries as $gallery) {
                    if (isset($request->$gallery)) {
                        $galleryImage = $this->storeGalleryBase64($request->$gallery);
                        MultiImg::insert([
                            'product_id' => $product_id,
                            'photo_name' => $galleryImage,
                            'created_at' => Carbon::now(),
                        ]);
                    }
                }
            

        } catch (\Exception $e) {
            DB::rollBack();
            Log::critical(__METHOD__ . ' method not working.' . $e->getMessage());
            $notification = array(
                'message' => 'Upload failed. Error: '. $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('all.products')->with($notification);
        }
        DB::commit();

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.products')->with($notification);
    }

    public function EditProduct(Request $request)
    {

        $userData = ProfileHelper::GetAuthUserData();
        $activeVendors = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        $multiImages = MultiImg::where('product_id', $request->id)->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $product = Product::findOrFail($request->id);
        return view('backend.product.edit_product', compact('brands', 'categories', 'activeVendors', 'product', 'subcategory', 'multiImages', 'userData'));
    }

    public function UpdateProduct(Request $request)
    {
        DB::beginTransaction();
        try {
            $product_id = $request->id;

            Product::findOrFail($product_id)->update([

                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),

                'product_code' => $request->product_code,
                'product_qty' => $request->product_qty,
                'product_tags' => $request->product_tags,
                'product_size' => $request->product_size,
                'product_color' => $request->product_color,

                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,

                'hot_deals' => $request->hot_deals,
                'featured' => $request->featured,
                'special_offer' => $request->special_offer,
                'special_deals' => $request->special_deals,


                'vendor_id' => $request->vendor_id,
                'status' => 1,
                'created_at' => Carbon::now(),

            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::critical(__METHOD__ . ' method not working.' . $e->getMessage());
            $notification = array(
                'message' => 'Your image sizes are too large.',
                'alert-type' => 'error'
            );
            return redirect()->route('all.products')->with($notification);
        }
        DB::commit();


        $notification = array(
            'message' => 'Product Updated Without Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.products')->with($notification);
    }

    public function UpdateProductThumbnail(Request $request)
    {

        $product_id = $request->id;
        $old_Image = $request->old_image;
        $save_url = $this->storeBase64($request->image_base64);

        unlink(ltrim($request->old_image, '/'));

        Product::findOrFail($product_id)->update([

            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Image Thumbnail Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.products')->with($notification);
    }

    public function AddProductGallery(Request $request)
    {
        
         /// Multiple Image Upload From here //////

         $galleries = ['gallery_image1_base64', 'gallery_image2_base64'];

         foreach ($galleries as $gallery) {
             if (isset($request->$gallery)) {
                 $galleryImage = $this->storeGalleryBase64($request->$gallery);
                 MultiImg::insert([
                     'product_id' => $request->product_id,
                     'photo_name' => $galleryImage,
                     'created_at' => Carbon::now(),
                 ]);
             }
         }

            $notification = array(
                'message' => 'Product gallery added successfully!',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.products')->with($notification);
        
    }

    public function UpdateProductMultiimages(Request $request)
    {
        DB::beginTransaction();
        try {
            $imgs = $request->multi_img;

            foreach ($imgs as $id => $img) {
                $imgDel = MultiImg::findOrFail($id);
                unlink($imgDel->photo_name);

                $uploadPath = ImageFileSizesHelper::ProductImagesResizeImage($img);

                MultiImg::where('id', $id)->update([
                    'photo_name' => $uploadPath,
                    'updated_at' => Carbon::now(),

                ]);
            } // end foreach
        } catch (\Exception $e) {
            DB::rollBack();
            Log::critical(__METHOD__ . ' method not working.' . $e->getMessage());
            $notification = array(
                'message' => 'Your image sizes are too large.',
                'alert-type' => 'error'
            );
            return redirect()->route('all.products')->with($notification);
        }
        DB::commit();

        $notification = array(
            'message' => 'Product MultiImages Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.products')->with($notification);
    }

    public function RemoveProductImages(Request $request)
    {
        $imageIds = $request->input('image_ids');

        if (!empty($imageIds)) {
            $images = MultiImg::whereIn('id', $imageIds)->get();

            foreach ($images as $image) {
                if (file_exists(public_path($image->photo_name))) {
                    unlink(public_path($image->photo_name));
                }
                $image->delete();
            }

            $notification = array(
                'message' => 'Selected images deleted successfully.',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'No images selected for deletion.',
                'alert-type' => 'error'
            );
        }

        return redirect()->route('all.products')->with($notification);
    }

    public function ChangeStatus(Request $request)
    {
        $product_id = $request->id;
        $product = Product::findOrFail($product_id);

        // Toggle status
        $product->status = $product->status = 1 ? 0 : 1;
        $product->save();

        $notification = array(
            'message' => 'Product status updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function RemoveProduct(Request $request)
    {

        $product = Product::findOrFail($request->id);
        unlink(ltrim($product->product_thumbnail, '/'));
        Product::findOrFail($request->id)->delete();

        $imges = MultiImg::where('product_id', $request->id)->get();
        foreach ($imges as $img) {
            unlink(ltrim($img->photo_name, '/'));
            MultiImg::where('product_id', $request->id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
