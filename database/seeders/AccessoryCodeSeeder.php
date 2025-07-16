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
        $existingCodes = [];
        $products = Accessory::whereNull('code')->orderBy('id')->get();

        foreach ($products as $product) {
            // Get the next unique code
            $code = $this->getNextAvailableCode($existingCodes);
            $product->code = $code;
            $product->save();

            $existingCodes[] = $code;
        }
    }

    private function getNextAvailableCode(array $existingCodes): string
    {
        static $prefix = 'a';
        static $number = 1;

        while (true) {
            $code = $prefix . $number;

            if (!in_array($code, $existingCodes) &&
                !Accessory::where('code', $code)->exists()) {
                // Prepare next values for future call
                if ($number < 9) {
                    $number++;
                } else {
                    $prefix = nextPrefix($prefix);
                    $number = 1;
                }

                return $code;
            }

            if ($number < 9) {
                $number++;
            } else {
                $prefix = nextPrefix($prefix);
                $number = 1;
            }
        }
    }
}
