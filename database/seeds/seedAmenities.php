<?php

use Illuminate\Database\Seeder;
use App\Amenity;

class seedAmenities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amenities = [
            'outdoor pool'    => 'c',
            'indoor pool'    => 'c',
            'heated pool'    => 'c',
            'saline pool'    => 'c',
            'kiddie pool'    => 'c',
            'zero-entry pool'    => 'c',
            'hot tub'    => 'c',
            'jacuzzi'    => 'c',
            'elevator'    => 'c',
            'steam room'    => 'c',
            'fitness room'    => 'c',
            'bar'    => 'c',
            'nature walk'    => 'c',
            'dog run'    => 'c',
            'bbq area'    => 'c',
            'sauna'    => 'c',
            'laundry'    => 'c',
            'golf course'    => 'c',
            'tennis courts'    => 'c',
            'basketball courts'    => 'c',

            'trundle bed'    => 'u',
            'sleeper sofa'    => 'u',
            'laundry'    => 'u',
            'cable tv'    => 'u',
            'satelite tv'    => 'u',
            'internet'    => 'u',
            'WiFi'    => 'u',
            'balcony'    => 'u',
            'patio'    => 'u',
            'pet friendly'    => 'u',
        ];

        foreach ($amenities as $key => $value)
        {
            Amenity::create(['name' => $key, 'type' => $value]);
        }
    }
}
