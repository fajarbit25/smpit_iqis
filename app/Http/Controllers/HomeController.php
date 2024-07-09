<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{

    public function index():View
    {
        $client = new Client();
        $apiToken = env('SIMS_API_TOKEN');
        $getDataApi = $client->request('GET', 'https://sim.iqis.sch.id/api/data/3/get', [
            'headers' => [
                'Authorization' => $apiToken,
            ]
        ]);

        $response = json_decode($getDataApi->getBody(), true);

        $data = [
            'title'     => 'SMPIT - Ibnul Qayyim Islamic School',
            'data'      => $response,
        ];
        return view('home', $data);
    }
}
