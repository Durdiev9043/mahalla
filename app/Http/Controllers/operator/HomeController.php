<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\Daily;
use App\Models\Location;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $data=Daily::whereDate('created_at', Carbon::today())->get();
            $count_come=count($data);
            $dd=count(Daily::where('created_at','<',Carbon::today()->addHours(9))->get());
            $uu=count(User::all());
            $ut=count(User::where('village_id',NULL)->get());
            $count=$uu-$ut-$count_come;
        return view('operator.home',['data'=>$data,'count_come'=>$count_come,'dd'=>$dd,'count'=>$count]);
    }

    public function extraLocation()
    {
        $data=Location::where('district_id',Auth::user()->district_id)->get();
        return view('operator.location.extra',['data'=>$data]);
    }
    public function seven()
    {


        $data=User::whereNotNull('village_id')->get();

        return view('operator.user',['data'=>$data]);
    }
    public function date(Request $request)
    {
        $data=Daily::where('created_at', $request->date)->get();

        return view('operator.date',['data'=>$data]);
    }


    public function compareFaces(Request $request)
    {// Rasm fayllarini olish

        $user=User::where('id',3)->first();
        $image1 = $request->file('image1');
//        $image2 = $request->file('image2');
        $image2Path = 'http://mahalla.amusoft.uz/storage/galereya/'.$user->img;
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
//                    'contents' => $image2Path,//fopen($image2->getRealPath(), 'r'),
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
            return response()->json([
                'message' => 'Ikkala rasm bitta shaxsga tegishli.',
                'confidence' => $data['confidence']
            ]);
        } else {
            return response()->json([
                'message' => 'Bu ikkala rasm boshqa shaxslarga tegishli.',
                'confidence' => $data['confidence']
            ]);
        }
    }
}
