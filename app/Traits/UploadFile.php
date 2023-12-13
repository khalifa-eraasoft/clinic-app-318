<?php

namespace App\Traits;


trait UploadFile
{
    public static function upload($input, $path)
    {
        $extension = $input->getClientOriginalExtension();
        $imageName = time() . rand(10000, 200000) . '.' . $extension;
        $input->move(public_path($path), $imageName);
        return $imageName;
    }
}
