<?php

namespace App\Helpers;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class ImageFilter implements FilterInterface
{          
    /**
     * Get the blur value
     * Use values between 0 and 100
     *
     * @var int
     */
    private $blur;  

    /**
     * Get the brightness value 
     * Use values between -100 for min brightness, 0 for no change and 100 for max brightness
     *
     * @var int
     */
    private $brightness;

    /**
     * Get the contrast value
     * Use values between -100 for min contrast 0 for no change and 100 for max contrast
     *
     * @var int
     */
    private $contrast;  
    
    /**
     * Create a new instance of class
     *
     * @param  int $blur
     * @param  int $brightness
     * @param  int $contrast
     */
    public function __construct($blur, $brightness, $contrast)
    {
        $this->blur         = $blur;
        $this->brightness   = $brightness;
        $this->contrast     = $contrast;
    }
    
    /**
     * Used to implemet the filters choosed by the user.
     *
     * @param  Image $image
     * @return Image
     */
    public function applyFilter(Image $image)
    {
        return $image
            ->blur($this->blur)
            ->brightness($this->brightness)
            ->contrast($this->contrast);
    }
    
    /**
     * Check if the image was sent.
     * If was setted some value to blur, brightness or contrast, verify if the values are OK in the right interval.
     * In that values was sended as string, they will be changed to 0, don't impacting in the filtering.
     *
     * @param  Request $data
     * @return string
     */
    public static function validate($data)
    {
        if(empty($data->image)){
            return 'Image Not Attached';
        }

        if(!empty($data->blur) && (intval($data->blur) < 0 || intval($data->blur) > 100)){
            return 'Blur value must be between 0 and 100';
        }

        if(!empty($data->brightness) && (intval($data->brightness) < -100 || intval($data->brightness) > 100)){
            return 'Brightness value must be between -100 and 100';
        }

        if(!empty($data->contrast) && (intval($data->contrast) < -100 || intval($data->contrast) > 100)){
            return 'Contrast value must be between -100 and 100';
        }

        return 'success';
    }
}
