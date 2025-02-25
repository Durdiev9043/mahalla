<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('operator.home');
    }
    public function compareFaces(Request $request)
    {// Rasm fayllarini olish
        $image1 = $request->file('image1');
        $image2 = $request->file('image2');

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
