<?php

/**
 * This package is a wrapper for v1 of the VideoCloud Analytics API <a href="https://apis.support.brightcove.com/analytics/index.html">https://apis.support.brightcove.com/analytics/index.html</a>
 * @link https://apis.support.brightcove.com/analytics/index.html
 * 
 * It was created by Jason Adriaan.
 * You can buy me a coffee 
 * @link https://www.buymeacoffee.com/jasonadriaan
 */

namespace Jasonadriaan\VideoCloudAnalytics;
use Illuminate\Support\Facades\Http;

class VideoCloudAnalytics
{
    private $query;

    // This method sets up the API query

    public function __construct(){
        $this->query = 'https://analytics.api.brightcove.com/v1/data?accounts=' . config('videocloud.account_id');
        return $this;
    }

    // Input Parameter: Dimensions is a required parameter

    public function dimensions($input){
        $this->query = $this->query . '&dimensions=' . $input; 
        return $this;
    }


    // Input Parameter: Where is not required parameter

    public function where($input){ 
        $this->query = $this->query . '&where=' . $input; 
        return $this;
    }

    // Limit is not a required parameter. It will default to 10 if not explicitly set.

    public function limit($input){ 
        $this->query = $this->query . '&limit=' . $input; 
        return $this;
    }
    
    // Offset is not a required parameter.

    public function offset($input){ 
        $this->query = $this->query . '&offset=' . $input; 
        return $this;
    }

    // Sort is not a required parameter.

    public function sort($input){ 
        $this->query = $this->query . '&sort=' . $input; 
        return $this;
    }

    // Fields is not a required parameter.

    public function fields($input){ 
        $this->query = $this->query . '&fields=' . $input; 
        return $this;
    }

    // Reconiled is not a required parameter.

    public function reconciled($input){ 
        $this->query = $this->query . '&reconciled=' . $input; 
        return $this;
    }

    // From is not a required parameter.

    public function from($input){ 
        $this->query = $this->query . '&from=' . $input; 
        return $this;
    }

    // To is not a required parameter.

    public function to($input){ 
        $this->query = $this->query . '&to=' . $input; 
        return $this;
    }

    // This method is called in the background to create an authentication token.

    private function authenticate(){

         $auth_string = config('videocloud.api_key') . ':' . config('videocloud.api_secret');
         $credentials = base64_encode($auth_string);

         $response = Http::withHeaders([
             'Content-Type' => 'application/x-www-form-urlencoded',
             'Authorization' => 'Basic ' . $credentials,
         ])->post('https://oauth.brightcove.com/v4/access_token?grant_type=client_credentials');

         $response->throw();

         $access_token = $response->object()->access_token;
         $headers = array('Authorization' => ' Bearer ' . $access_token, 'content-type' => 'application/json');

         return $headers;
    }

    // This is where the actual call is made and it returns a Laravel Collection for your convenience.

    public function get(){

        $headers = $this->authenticate();
        $response = Http::withHeaders($headers)->get($this->query);

        return $response->collect();

    }

}
