<?php

namespace App\Http\Controllers;

use App\Helpers\ImageFilter;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic;

/**
 * ImageController
 */
class ImageController extends Controller
{    
    /**
     * Filter Controller
     * The cache method is used for the result optimization.
     *
     * @param  Request $request
     * @return Image
     */
    public function filter(Request $request)
    {
        $validate = ImageFilter::validate($request);
        if($validate != 'success'){
            return response()->json(['error' => $validate], 500);
        }

        $blur = !empty($request->blur) ? intval($request->blur) : 0;
        $brightness = !empty($request->brightness) ? intval($request->brightness) : 0;
        $contrast = !empty($request->contrast) ? intval($request->contrast) : 0;

        $img = ImageManagerStatic::cache(function($image) use ($request, $blur, $brightness, $contrast){
            $imgExt = $request->image->getClientOriginalExtension();
            $img = $image->make($request->image->getPathName());
            $img->filter(new ImageFilter($blur, $brightness, $contrast));
        });
        
        return ImageManagerStatic::make($img)->response();
    }
}
