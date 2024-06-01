<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Helpers\ImageFileSizesHelper;

class BannerController extends Controller
{
    public function AllBanners()
    {
        $banners = Banner::latest()->get();
        return view('backend.banner.all_banners', compact('banners'));
    }

    public function AddBanner()
    {
        return view('backend.banner.add_banner');
    }

    public function StoreBanner(Request $request)
    {

        if ($request->file('banner_image')) {
            $save_url = ImageFileSizesHelper::BannerImagesResizeImage($request->file('banner_image'));
            Banner::insert([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
                'banner_image' => $save_url,
            ]);
        } else {
            Banner::insert([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
            ]);
        }
        $notification = array(
            'message' => 'Banner Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.banners')->with($notification);
    }

    public function EditBanner(Request $request)
    {
        $banner = Banner::findOrFail($request->id);
        return view('backend.banner.edit_banner', compact('banner'));
    }

    public function UpdateBanner(Request $request)
    {

        $banner_id = $request->id;
        $old_img = $request->old_img;

        if ($request->file('banner_image')) {

            $save_url = ImageFileSizesHelper::BannerImagesResizeImage($request->file('banner_image'));

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            Banner::findOrFail($banner_id)->update([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
                'banner_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Banner Updated with image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.banners')->with($notification);
        } else {

            Banner::findOrFail($banner_id)->update([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
            ]);

            $notification = array(
                'message' => 'Banner Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.banners')->with($notification);
        } // end else

    }

    public function RemoveBanner(Request $request)
    {

        $banner = Banner::findOrFail($request->id);
        $img = $banner->banner_image;
        if($img){
            unlink($img);
        }
        Banner::findOrFail($request->id)->delete();

        $notification = array(
            'message' => 'Banner Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
