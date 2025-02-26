<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;

class HomeController extends BaseController
{
    public function come(Request $request){
        $user=User::where('id',$request->user_id)->first();


        $image1 = $request->file('image');
        $image2 = asset('/storage/galereya/'.$user->img);

        // Face++ API kalitlari
        $apiKey = '8Ca-AagNWYsSnnGE3U9PuMaVwfnckc39';
        $apiSecret = '07d_l6Zwh7gNBb4PZRR9knYJHHI3-uaP';

        // GuzzleHTTP orqali Face++ API-ga so'rov yuborish
        $client = new Client();

        // Fayllarni to'g'ri yuborish
        $response = $client->post('https://api-us.faceplusplus.com/facepp/v3/compare', [
            'multipart' => [
                [
                    'name' => 'api_key',
                    'contents' => $apiKey,
                ],
                [
                    'name' => 'api_secret',
                    'contents' => $apiSecret,
                ],
                [
                    'name' => 'image_file1',
                    'contents' => fopen($image1->getRealPath(), 'r'),
                    'filename' => $image1->getClientOriginalName(),
                ],
                [
                    'name' => 'image_file2',
                    'contents' => fopen($image2->getRealPath(), 'r'),
                    'filename' => $image2->getClientOriginalName(),
                ],
            ],
        ]);

        // Natijani olish
        $data = json_decode($response->getBody()->getContents(), true);

        // Natijani tekshirish va qaytarish
        if (isset($data['confidence']) && $data['confidence'] > 80) {
            // return response()->json([
            //     'message' => 'Ikkala rasm bitta shaxsga tegishli.',
            //     'confidence' => $data['confidence']
            // ]);


            $latitude1 = $request->lat;
            $longitude1 = $request->lang;
            $latitude2 = Location::where('village_id', $user->village_id)->first()->lat;
            $longitude2 = Location::where('village_id', $user->village_id)->first()->lang;
            if (($latitude1 == $latitude2) && ($longitude1 == $longitude2)) {
                return 0;
            } // distance is zero because they're the same point

            $p1 = deg2rad($latitude1);
            $p2 = deg2rad($latitude2);

            $dp = deg2rad($latitude2 - $latitude1);
            $dl = deg2rad($longitude2 - $longitude1);

            $a = (sin($dp / 2) * sin($dp / 2)) + (cos($p1) * cos($p2) * sin($dl / 2) * sin($dl / 2));
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            $r = 6371008; // Earth's average radius, in meters
            $d = $r * $c;

            if ($d <= 150) {

                    /*$data = Daily::create([
                        'user_id' => $id,
                        'latt' => $request->latt,
                        'lang' => $request->lang,
                        'day' => Carbon::today(),
                        'time' => $request->time,
                    ]);*/

                if ($data) {
                    return $this->sendSuccess($d, 'Siz ishga yetib keldingiz'); // distance, in meters
                }
            } else {
                return $this->sendSuccess($d, 'Siz manzilga yetib bormagansiz'); // distance, in meters
            }


        } else {
           return $this->sendError('Foydalanuvchining Biometrik malumotlarini tekshirishda xatolik.', ['error'=>'Unauthorised']);
        }






    }
}
