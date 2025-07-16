<?php

use App\Models\Accessory;

if (!function_exists('getNextAccessoryCode')) {
    function getNextAccessoryCode()
    {
        $lastCode = Accessory::orderByDesc('id')->value('code');

        if (!$lastCode) {
            return 'a1';
        }

        preg_match('/^([a-z]+)(\d+)$/', $lastCode, $matches);
        $prefix = $matches[1];
        $number = (int)$matches[2];

        if ($number < 9) {
            $number += 1;
        } else {
            $prefix = nextPrefix($prefix);
            $number = 1;
        }

        return $prefix . $number;
    }
}

if (!function_exists('nextPrefix')) {
    function nextPrefix($prefix)
    {
        $chars = str_split($prefix);
        $length = count($chars);
        $i = $length - 1;

        while ($i >= 0) {
            if ($chars[$i] !== 'z') {
                $chars[$i] = chr(ord($chars[$i]) + 1);
                break;
            } else {
                $chars[$i] = 'a';
                $i--;
            }
        }

        if ($i < 0) {
            array_unshift($chars, 'a');
        }

        return implode('', $chars);
    }
}
