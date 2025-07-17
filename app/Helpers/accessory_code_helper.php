<?php

use App\Models\Accessory;

if (!function_exists('getNextAccessoryCode')) {
    function getNextAccessoryCode(string $categoryTitle): string
    {
        $prefix = getPrefixFromCategory($categoryTitle);

        // Find latest code with this prefix
        $latestCode = Accessory::where('code', 'like', $prefix . '%')
                             ->orderByDesc('code')
                             ->value('code');

        $nextNumber = 1;

        if ($latestCode) {
            $numberPart = (int)substr($latestCode, strlen($prefix));
            $nextNumber = $numberPart + 1;
        }

        return $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT); // e.g. CA001
    }
}

if (!function_exists('getPrefixFromCategory')) {
    function getPrefixFromCategory(string $title): string
    {
        $clean = preg_replace('/[^a-zA-Z]/', '', $title); // Remove non-letters

        $first = strtoupper($clean[0] ?? 'X');
        $last = strtoupper($clean[strlen($clean) - 1] ?? 'X');

        return $first . $last; // e.g. CA, ME, etc.
    }
}

