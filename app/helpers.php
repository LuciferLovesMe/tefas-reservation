<?php

use Carbon\Carbon;

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
        return $fileName . $fileType;
    }
}

if (!function_exists('dateFormat')) {
    function dateFormat($date)
    {
        if (!$date) {
            return '-'; // Atau string kosong sesuai kebutuhan
        }

        // Set locale ke bahasa Indonesia
        Carbon::setLocale('id');

        // Parse datetime dan format sesuai keinginan
        return Carbon::parse($date)->translatedFormat('d F Y');
    }
}

if (!function_exists('datetimeFormat')) {
    function datetimeFormat($date)
    {
        if (!$date) {
            return '-'; // Atau string kosong sesuai kebutuhan
        }

        // Set locale ke bahasa Indonesia
        Carbon::setLocale('id');

        // Parse datetime dan format sesuai keinginan
        return Carbon::parse($date)->translatedFormat('d F Y H:i');
    }
}