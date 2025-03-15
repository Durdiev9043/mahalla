<?php

namespace App\Services;

class ComeService
{
    public function __construct()
    {
        //
    }

    public function longer($latitude1,$latitude2,$longitude2,$longitude1)
    {
        $p1 = deg2rad($latitude1);
        $p2 = deg2rad($latitude2);

        $dp = deg2rad($latitude2 - $latitude1);
        $dl = deg2rad($longitude2 - $longitude1);

        $a = (sin($dp / 2) * sin($dp / 2)) + (cos($p1) * cos($p2) * sin($dl / 2) * sin($dl / 2));
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $r = 6371008; // Earth's average radius, in meters
        $d = $r * $c;
        return $d;

    }
}
