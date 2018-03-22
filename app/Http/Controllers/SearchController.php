<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provinces;
use App\Citys;

class SearchController extends Controller
{
    
    protected $fecth_direct;
    protected $endpoint;
    protected $key;


    public function __construct()
    {

        $this->endpoint = env('ENDPOINT_RAJAONGKIR');
        $this->key = env('KEY_RAJAONGKIR');

    }

    public function getProvice($id)
    {

            $provinces_pre1 = Provinces::where('province_id', $id)->first();
            $provinces_pre = array_except($provinces_pre1,['id']);

            $provinces = ['data' => $provinces_pre];
            return json_encode($provinces);
    }

    public function getCity($id)
    {
            $citys_pre1 = Citys::where('city_id', $id)->first();
            $citys_pre = array_except($citys_pre1,['id']);

            $citys = ['data' => $citys_pre];
            return json_encode($citys);
    }

    public function getCurl($v)
    {
        $curl = curl_init();
        $url = $this->endpoint.$v;
        $key = $this->key;

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: ".$key
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return "cURL Error #:" . $err;
        } else {
            $data_province = json_decode($response);
          return $data_province->rajaongkir->results;
        }
    }

}
