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

if (!function_exists('convertJenjang')) {
    function convertJenjang($value)
    {
        return match ($value) {
            '0' => 'TK',
            '1' => 'SD',
            '2' => 'SMP',
            '3' => 'SMA',
            0 => 'TK',
            1 => 'SD',
            2 => 'SMP',
            3 => 'SMA',
            // default => null,
            null => null,
        };
    }
}

if (!function_exists('convertJenjangToId')) {
    function convertJenjangToId($value)
    {
        return match ($value) {
            'TK' => 0,
            'SD' => 1,
            'SMP' => 2,
            'SMA' => 3,
            default => null,
        };
    }
}

if (!function_exists('convertWaktuPanen')) {
    function convertWaktuPanen($value)
    {
        $months = explode(',', $value);
        $monthNames = [];
        Carbon::setLocale('id');
        foreach ($months as $month) {
            $month = trim($month);
            $monthNames[] = Carbon::create()->month((int)$month)->translatedFormat('F');
        }
        return implode(', ', $monthNames);
    }
}

if (!function_exists(('waktuPanenOptions'))) {
    function waktuPanenOptions()
    {
        $options = [];
        Carbon::setLocale('id');
        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->translatedFormat('F');
            $options[$i] = $monthName;
        }
        return $options;
    }
}