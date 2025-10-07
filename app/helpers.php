<?php

use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

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

if (!function_exists('alertSuccess')) {
    function alertSuccess($message)
    {
        Alert::success('Berhasil', $message)->autoClose(3000);
    }
}

if (!function_exists('alertError')) {
    function alertError($message)
    {
        Alert::error('Gagal', $message)->autoClose(3000);
    }
}

if (!function_exists('alertInfo')) {
    function alertInfo($message)
    {
        Alert::info('Info', $message)->autoClose(3000);
    }
}