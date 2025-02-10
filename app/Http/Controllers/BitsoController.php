<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BitsoController extends Controller
{


    protected function getBitsoRequest($url, $method = "GET", $json = null)
	{
		$nonce = (integer)round(microtime(true) * 10000 * 100);
		$message = $nonce.$method.$url.$json;
		$signature = hash_hmac('sha256', $message, $this->bitsoSecret);

		$format = 'Bitso %s:%s:%s';
		$authHeader =  sprintf($format, $this->bitsoKey, $nonce, $signature);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.bitso.com". $url);

		if ($method == 'DELETE'){
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		}

		if ( !is_null($json) ){
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, "true");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '. $authHeader,'Content-Type: application/json'));
		$response = curl_exec($ch);

		$json = json_decode($response);

		if(isset($json->error)){
			var_dump($json->error->message);
		}

		return $response;
	}

    public function getTicker()
	{
		$payload = $this->getBitsoRequest("/v3/ticker/");

		$json   = json_decode($payload);
		$ticker = $json->payload;
		$currencys = array();

        return $ticker;

		foreach ($ticker as $value) {
			if( strpos($value->book, "_mxn") or strpos($value->book, "_usd") ){
				$currencys[$value->book] = array(
                    "last"      => $value->last,
                    "high"      => $value->high,
                    "low"       => $value->low,
                    "change_24" => $value->change_24
                );
			}
		}

		return $currencys;
	}

    public function getBalance()
	{
        $payload = $this->getBitsoRequest("/v3/balance/");
        $object = json_decode($payload);

        $results = array();
        foreach ($object->payload->balances as $key => $value) {
            if ($value->total > 0.0002){
                $results[] = $value;
            }
        }

        return $results;
	}
}
