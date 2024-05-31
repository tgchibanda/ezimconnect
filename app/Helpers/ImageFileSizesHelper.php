<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageFileSizesHelper
{

    public static function BrandResizeImage($imageLink)
    {
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($imageLink);

        $name_gen = hexdec(uniqid()) . '.' . $imageLink->getClientOriginalExtension();
        // scale down to fixed width
        $image->cover(300, 300);
        $image->save('upload/brand/' . $name_gen);
        $save_url = 'upload/brand/' . $name_gen;

        return $save_url;
    }

    public static function CategoryResizeImage($imageLink)
    {
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($imageLink);

        $name_gen = hexdec(uniqid()) . '.' . $imageLink->getClientOriginalExtension();
        // scale down to fixed width
        $image->cover(120, 120);
        $image->save('upload/category/' . $name_gen);
        $save_url = 'upload/category/' . $name_gen;

        return $save_url;
    }

    public static function ProductThumbanailResizeImage($imageLink)
    {
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($imageLink);

        $name_gen = hexdec(uniqid()) . '.' . $imageLink->getClientOriginalExtension();
        // scale down to fixed width
        $image->cover(800, 800);
        $image->save('upload/products/thumbnail/' . $name_gen);
        $save_url = 'upload/products/thumbnail/' . $name_gen;

        return $save_url;
    }

    public static function ProductImagesResizeImage($imageLink)
    {
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($imageLink);

        $name_gen = hexdec(uniqid()) . '.' . $imageLink->getClientOriginalExtension();
        // scale down to fixed width
        $image->cover(800, 800);
        $image->save('upload/products/multi-image/' . $name_gen);
        $save_url = 'upload/products/multi-image/' . $name_gen;

        return $save_url;
    }

}
