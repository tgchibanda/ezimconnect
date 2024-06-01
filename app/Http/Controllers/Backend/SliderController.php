<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Helpers\ImageFileSizesHelper;

class SliderController extends Controller
{
    public function AllSliders()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.all_sliders', compact('sliders'));
    }

    public function AddSlider()
    {
        return view('backend.slider.add_slider');
    }

    public function StoreSlider(Request $request)
    {

        if ($request->file('slider_image')) {
            $save_url = ImageFileSizesHelper::SliderImagesResizeImage($request->file('slider_image'));
            Slider::insert([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'slider_image' => $save_url,
            ]);
        } else {
            Slider::insert([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
            ]);
        }
        $notification = array(
            'message' => 'Slider Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.sliders')->with($notification);
    }

    public function EditSlider(Request $request)
    {
        $slider = Slider::findOrFail($request->id);
        return view('backend.slider.edit_slider', compact('slider'));
    }

    public function UpdateSlider(Request $request)
    {

        $slider_id = $request->id;
        $old_img = $request->old_img;

        if ($request->file('slider_image')) {

            $save_url = ImageFileSizesHelper::SliderImagesResizeImage($request->file('slider_image'));

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'slider_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Slider Updated with image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.sliders')->with($notification);
        } else {

            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
            ]);

            $notification = array(
                'message' => 'Slider Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.sliders')->with($notification);
        } // end else

    }

    public function RemoveSlider(Request $request)
    {

        $slider = Slider::findOrFail($request->id);
        $img = $slider->slider_image;
        if($img){
            unlink($img);
        }
        Slider::findOrFail($request->id)->delete();

        $notification = array(
            'message' => 'Slider Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
