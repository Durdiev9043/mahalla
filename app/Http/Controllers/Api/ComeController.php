<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Daily;
use App\Models\Location;
use App\Models\User;
use App\Services\ComeService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ComeController extends Controller
{
    public function come(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $dd = Daily::where('user_id', $user->id)->where('day',Carbon::today())->first();
        //created_at->format('d.m.Y')  == Carbon::now()->format('d.m.Y')
//        foreach ($dd as $item) {
        if ($dd) {
            return $this->sendError('Siz manzilga allaqachon yetib kelgansiz', ['error' => 'error']);
        }
//        }
        else{

            $image1 = $request->file('image');
//        $image2 = asset('/storage/galereya/'.$user->img);
            $image2Path = 'http://mahalla.amusoft.uz/storage/galereya/' . $user->img;

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
//                    'contents' => fopen($image2->getRealPath(), 'r'),
//                    'filename' => $image2->getClientOriginalName(),
                        'contents' => fopen($image2Path, 'r'),
                        'filename' => $user->img,
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
                    $data = Daily::create([
                        'user_id' => $user->id,
                        'lat' => $request->lat,
                        'lang' => $request->lang,
                        'day' => Carbon::today(),
                        'time' => 0,
                    ]);

                    if ($data) {
                        return $this->sendResponse(0, 'Siz ishga yetib keldingiz'); // distance, in meters
                    }
                } // distance is zero because they're the same point

                $d=(new ComeService())->longer($latitude1,$latitude2,$longitude1,$longitude2);
                if ($d <= 150) {

                    $data = Daily::create([
                        'user_id' => $user->id,
                        'lat' => $request->lat,
                        'lang' => $request->lang,
                        'day' => Carbon::today(),
                        'time' => 0,
                    ]);

                    if ($data) {
                        return $this->sendResponse($d, 'Siz ishga yetib keldingiz'); // distance, in meters
                    }
                } else {
                    return $this->sendError('Siz manzilga yetib bormagansiz', ['error' => $d]); // distance, in meters
                }


            } else {
                return $this->sendError('Foydalanuvchining Biometrik malumotlarini tekshirishda xatolik.', ['error' => 'Xatolik']);
            }

        }

    }
    public function hokimyat(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $dd = Daily::where('user_id', $user->id)->where('day',Carbon::today())->first();
        //created_at->format('d.m.Y')  == Carbon::now()->format('d.m.Y')
//        foreach ($dd as $item) {
        if ($dd) {
            return $this->sendError('Siz manzilga allaqachon yetib kelgansiz', ['error' => 'error']);
        }
//        }
        else{

            $image1 = $request->file('image');
//        $image2 = asset('/storage/galereya/'.$user->img);
            $image2Path = 'http://mahalla.amusoft.uz/storage/galereya/' . $user->img;

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
//                    'contents' => fopen($image2->getRealPath(), 'r'),
//                    'filename' => $image2->getClientOriginalName(),
                        'contents' => fopen($image2Path, 'r'),
                        'filename' => $user->img,
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
                $latitude2=Location::where('district_id',$user->district_id)->where('type',1)->first()->lat;
                $longitude2=Location::where('district_id',$user->district_id)->where('type',1)->first()->lang;
//                $latitude2 = Location::where('village_id', $user->village_id)->first()->lat;
//                $longitude2 = Location::where('village_id', $user->village_id)->first()->lang;
                if (($latitude1 == $latitude2) && ($longitude1 == $longitude2)) {
                    $data = Daily::create([
                        'user_id' => $user->id,
                        'lat' => $request->lat,
                        'lang' => $request->lang,
                        'day' => Carbon::today(),
                        'time' => 0,
                    ]);

                    if ($data) {
                        return $this->sendResponse(0, 'Siz ishga yetib keldingiz'); // distance, in meters
                    }
                } // distance is zero because they're the same point

                $d=(new ComeService())->longer($latitude1,$latitude2,$longitude1,$longitude2);
                if ($d <= 150) {

                    $data = Daily::create([
                        'user_id' => $user->id,
                        'lat' => $request->lat,
                        'lang' => $request->lang,
                        'day' => Carbon::today(),
                        'time' => 0,
                    ]);

                    if ($data) {
                        return $this->sendResponse($d, 'Siz ishga yetib keldingiz'); // distance, in meters
                    }
                } else {
                    return $this->sendError('Siz manzilga yetib bormagansiz', ['error' => $d]); // distance, in meters
                }


            } else {
                return $this->sendError('Foydalanuvchining Biometrik malumotlarini tekshirishda xatolik.', ['error' => 'Xatolik']);
            }

        }

    }
}
