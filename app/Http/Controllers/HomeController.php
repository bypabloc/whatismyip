<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $api_ip = new \App\Funciones\ApiIp;
        $freegeoip_app = $api_ip->freegeoip_app();
        // $api_ipstack_com = $api_ip->api_ipstack_com(['access_key'=>'e4a01483a21395c73b43dac675321294']);

        $data = [
            'ip_data' => self::ip_data(),
            'freegeoip_app' => $freegeoip_app['data'],
        ];

        return view('welcome',['data'=>$data]);

        return view('welcome');
    }

    function ip_data(){
        return [
            'gethostname()' => gethostname(),
            'get_client_ip()' => self::get_client_ip(),
            'gethostbyaddr(self::get_client_ip())' => gethostbyaddr(self::get_client_ip()),
            'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
            'SERVER_NAME' => $_SERVER['SERVER_NAME'],
        ];
    }

    function get_client_ip(){
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
