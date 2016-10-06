<?php

namespace app\traits;


use Eventviva\ImageResize;

trait imageHandler
{

    public static function makeSmallerIfNecessary($image_path, $width, $height, $smaller)
    {

        $image = new ImageResize($image_path);
        $image->resizeToBestFit($width, $height, $allow_enlarge = false);
        $image->save($smaller);

        return true;
    }


}