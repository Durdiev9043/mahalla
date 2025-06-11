<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\CurrentLocation;
use App\Models\Daily;
use App\Models\Location;
use App\Models\User;
use App\Models\Village;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function currentLocationVillage($id)
    {
        $users = User::where('village_id',$id)->where('role',3)->select('*')
            ->addSelect([
                'lat' => CurrentLocation::select('lat')
                    ->whereColumn('user_id', 'users.id')
                    ->latest('created_at')
                    ->limit(1),
                'lang' => CurrentLocation::select('lang')
                    ->whereColumn('user_id', 'users.id')
                    ->latest('created_at')
                    ->limit(1),
                'location_created_at' => CurrentLocation::select('created_at')
                    ->whereColumn('user_id', 'users.id')
                    ->latest('created_at')
                    ->limit(1),
            ])
            ->get();

        $villages=Village::where('district_id',Auth::user()->district_id)->get();
        return view('operator.current.index',['users'=>$users,'villages'=>$villages]);

    }
    public function currentLocationVillageUser($id)
    {
//        $users = User::where('id',$id)->where('role',3)->select('*')
//            ->addSelect([
//                'lat' => CurrentLocation::select('lat')
//                    ->whereColumn('user_id', 'users.id')
//                    ->latest('created_at')
//                    ->limit(1),
//                'lang' => CurrentLocation::select('lang')
//                    ->whereColumn('user_id', 'users.id')
//                    ->latest('created_at')
//                    ->limit(1),
//                'location_created_at' => CurrentLocation::select('created_at')
//                    ->whereColumn('user_id', 'users.id')
//                    ->latest('created_at')
//                    ->limit(1),
//            ])
//            ->get();
        $users=CurrentLocation::where('user_id',$id)->get();

        $villages=Village::where('district_id',Auth::user()->district_id)->get();
        return view('operator.current.user',['users'=>$users,'villages'=>$villages]);

    }
public function currentLocation(){
    $users = User::where('district_id',Auth::user()->district_id)->where('role',3)->select('*')
        ->addSelect([
            'lat' => CurrentLocation::select('lat')
                ->whereColumn('user_id', 'users.id')
                ->latest('created_at')
                ->limit(1),
            'lang' => CurrentLocation::select('lang')
                ->whereColumn('user_id', 'users.id')
                ->latest('created_at')
                ->limit(1),
            'location_created_at' => CurrentLocation::select('created_at')
                ->whereColumn('user_id', 'users.id')
                ->latest('created_at')
                ->limit(1),
        ])
        ->get();

    $locations = DB::table('current_locations as l1')
        ->join(DB::raw('
        (SELECT user_id, MAX(created_at) as latest_time
         FROM current_locations
         GROUP BY user_id) as l2
    '), function($join) {
            $join->on('l1.user_id', '=', 'l2.user_id')
                ->on('l1.created_at', '=', 'l2.latest_time');
        })
        ->select('l1.user_id', 'l1.lat', 'l1.lang', 'l1.created_at')
        ->get();
//    dd($latestLocations);
$villages=Village::where('district_id',Auth::user()->district_id)->get();
    return view('operator.current.index',['locations' => $locations,'users'=>$users,'villages'=>$villages]);
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
