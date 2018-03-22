<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FetchData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetchdata:list  {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $endpoint;
    protected $key;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->endpoint = env('ENDPOINT_RAJAONGKIR');
        $this->key = env('KEY_RAJAONGKIR');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */


    public function handle()
    {
        //
        if($this->argument('name') == null){
            
            $this->getProvice();
            $this->getCity();

        } elseif($this->argument('name') == 'province') {
            $idprovince = $this->ask('Enter id province', 'all');
            $this->getProvice($idprovince);
        } elseif($this->argument('name') == 'city') {
            // $idprovince = $this->ask('Enter id province', 'all');
            $idcity = $this->ask('Enter id city', 'all');
            $this->getCity($idcity);

        } else {
            echo $this->argument('name');
        }
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
          // echo "cURL Error #:" . $err;
          return "cURL Error #:" . $err;
        } else {
          // echo $response;
          return $response;
        }
    }

    public function getProvice($idprovince=null)
    {
        // "https://api.rajaongkir.com/starter/province?id=12",
        if($idprovince == 'all' || $idprovince == null ){
            $url = $this->getCurl('/province');
        } else {
            $url = $this->getCurl('/province?id='.$idprovince);
        }

        $data_province = json_decode($url);
        $data_result = $data_province->rajaongkir->results;
        $count_result = count($data_result);

        if($count_result > 1){
            $bar = $this->output->createProgressBar($count_result);
            foreach ($data_province->rajaongkir->results as $v) {
                'App\Provinces'::updateOrCreate(
                    ['province_id'       => $v ->province_id],[
                    'province_id'     => $v->province_id,
                    'province'        => $v->province,
                ]);
                $bar->advance();
            }
            $bar->finish();
        } elseif ($count_result == 1){
                'App\provinces'::updateOrCreate(
                    ['province_id'       => $data_result ->province_id],[
                    'province_id'     => $data_result ->province_id,
                    'province'        => $data_result ->province,
                ]);
                echo 'success';
        } else {
            echo " id nothing";
        }

        // return $url;
    }

    public function getCity($idcity=null)
    {
        // "https://api.rajaongkir.com/starter/city?id=39&province=5",
            if($idcity == 'all' || $idcity == null ){
                $url = $this->getCurl('/city');
            } else {
                $url = $this->getCurl('/city?id='.$idcity);
            }

            $data_city = json_decode($url);
            $data_result = $data_city->rajaongkir->results;
            $count_result = count($data_result);

            if($count_result > 1){
                $bar = $this->output->createProgressBar($count_result);
                foreach ($data_city->rajaongkir->results as $v) {
                    'App\Citys'::updateOrCreate(
                        ['city_id'       => $v ->city_id],[
                        'city_id'       => $v->city_id,
                        'province_id'   => $v->province_id,
                        'province'      => $v->province,
                        'type'          => $v->type,
                        'city_name'     => $v->city_name,
                        'postal_code'   => $v->postal_code,
                    ]);
                    $bar->advance();
                }
                $bar->finish();
            } elseif ($count_result == 1){
                    'App\Citys'::updateOrCreate(
                        ['city_id'       => $data_result ->city_id],[
                        'city_id'       => $data_result->city_id,
                        'province_id'   => $data_result->province_id,
                        'province'      => $data_result->province,
                        'type'          => $data_result->type,
                        'city_name'     => $data_result->city_name,
                        'postal_code'   => $data_result->postal_code,
                    ]);
                    echo 'success';
            } else {
                echo " id nothing";
            }

        // return $url;
    }
}
