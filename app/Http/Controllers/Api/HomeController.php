<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Daily;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;

class HomeController extends BaseController
{


    public function about($id)
    {
        $user = User::where('id',$id)->first();
        $dd = Daily::where('user_id', $id)->where('day',Carbon::today())->first();
        $time=Carbon::parse('09:00:00');
        $nineAM = Carbon::today()->addHours(9);
        if ($dd){
            if ($dd->created_at->format('H:i:s') > $time) {
                $st = 0;
                $time_interval = 0;
            }else {
                $st = 1;
                $time_interval = $dd->created_at->diff($nineAM);
            }
        }

        if ($dd) {
            $data = [
                'come_time' => $dd->created_at->format('H:i:s'),
                'status' => $st,
                'time_interval' => $time_interval->h.':'.$time_interval->i ,

            ];
                return $this->sendResponse($data, 'Malumotlar'); // distance, in meters

        }
        else{
            return $this->sendError('Siz manzilga yetib kelmagansiz', ['error' => 'error']);
        }
    }

}
