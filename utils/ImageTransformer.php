<?php

class ImageTransformer
{
    static public function generate_thumbnail($file, $path) {
        $format = explode('/', mime_content_type($file))[1];
        $create = "imagecreatefrom{$format}";
        $img = $create($file);
        $thumb = imagescale($img, 200, 125);
        imagedestroy($img);
        imagepng($thumb, $path);
    }

    static public function generate_watermark($file, $path, $text) {
        $format = explode('/', mime_content_type($file))[1];
        $create = "imagecreatefrom{$format}";
        $img = $create($file);
        $color = imagecolorallocate($img, 0xff, 0xff, 0xff);
        $x = 10;
        $y = 20;
        $angle = 0;
        $font_size = 20;
        imagettftext($img, $font_size, $angle, $x, $y, $color, "../web/comici.ttf", $text);
        imagepng($img, $path);
        imagedestroy($img);
    }
}