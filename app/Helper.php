<?php


namespace App;

use Illuminate\Support\Facades\Storage;
use Resize;


class Helper
{
    /**
     * Creates a thumbnail of the submitted image
     * @param $path
     * @param $width
     * @param $height
     */
    public static function processImage($image, $name, $path, $width, $height)
    {

        $small_image = Resize::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        // Putting the image to the Server
        Storage::put($path . $name, $small_image->save());
    }

}
