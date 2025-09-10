<?php

if (!function_exists('storeImage')) {
    function storeImage($file, $path, $iteration = 1)
    {
        $uploadPath = public_path() . $path;
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
        $fileType = $file->getClientOriginalExtension();
        $fileName = time() . '-' . $iteration . '.';
        $file->move($uploadPath, $fileName . $fileType);
        return $uploadPath . '/' . $fileName . $fileType;
    }
}