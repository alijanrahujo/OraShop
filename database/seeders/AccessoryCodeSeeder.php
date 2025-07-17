<?php

namespace Database\Seeders;

use App\Models\Accessory;
use Illuminate\Database\Seeder;

class AccessoryCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usedCodes = [];

        // $products = Accessory::whereNull('code')->orderBy('id')->get();
        $products = Accessory::orderBy('id')->get();

        foreach ($products as $product) {
            $categoryTitle = $product->category->title ?? 'default';

            $code = $this->getUniqueCode($categoryTitle, $usedCodes);

            $product->code = $code;
            $product->save();

            $usedCodes[] = $code;
        }
    }

    private function getUniqueCode(string $categoryTitle, array $usedCodes): string
    {
        $prefix = getPrefixFromCategory($categoryTitle);
        $nextNumber = 1;

        while (true) {
            $code = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            if (!in_array($code, $usedCodes) &&
                !Accessory::where('code', $code)->exists()) {
                return $code;
            }

            $nextNumber++;
        }
    }
}
