<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $token = "14481915";
        $url = "https://api.hgbrasil.com/weather?key=$token&user_ip=remote"; 

        try{
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
        }catch(Exception $e){
            return $e->getMessage();
        }
        $response_json = json_decode($response);

        return view('dashboard', ['data' => $response_json]);
    }
}
