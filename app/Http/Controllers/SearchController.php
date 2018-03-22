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
        $this->fecth_direct = env('FECTH_DIRECT', false);
        $this->endpoint = env('ENDPOINT_RAJAONGKIR');
        $this->key = env('KEY_RAJAONGKIR');

    }

    public function getProvice($id)
    {
        if(!($this->fecth_direct)){
            $provinces_pre1 = Provinces::where('province_id', $id)->first();
            $provinces_pre = array_except($provinces_pre1,['id']);
        } else {
            $provinces_pre = $this->getCurl('/province?id='.$id);
        }
            $provinces = ['data' => $provinces_pre];
            return json_encode($provinces);
    }

    public function getCity($id)
    {
        if(!($this->fecth_direct)){
            $citys_pre1 = Citys::where('city_id', $id)->first();
            $citys_pre = array_except($citys_pre1,['id']);
        } else {
             $citys_pre = $this->getCurl('/city?id='.$id);
        }
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

    
        public function index()
    {
        $value = [2, 1, 6, 9, 4, 3, 11, 34, 17, 34, 34];
        
        rsort($value);

        $r = 1;
        $r1 = $value['1'];
        for ($i=0; $i < $r ; $i++) { 
            if($value['0'] == $r1){ 
                $r++;
                $r1 = $value[$r];
            } 
        }

        echo $r1;

        dump($value);
    }
}
