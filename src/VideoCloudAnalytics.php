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
    private $base_url;
    private $dimensions = '';
    private $where = '';
    private $limit = '';
    private $offset = '';
    private $sort = '';
    private $fields = '';
    private $reconciled = '';
    private $from = '';
    private $to = '';

    // This method sets up the API query

    public function __construct(){
        $this->base_url = 'https://analytics.api.brightcove.com/v1/data?accounts=' . config('videocloudanalytics.account_id');
        return $this;
    }

    public function get(){
        return $this->request(
                        $this->base_url 
                        . $this->dimensions 
                        . $this->where        
                        . $this->limit
                        . $this->offset 
                        . $this->sort 
                        . $this->fields
                        . $this->reconciled
                        . $this->from
                        . $this->to
        );
    }

    // Input Parameter: Dimensions is a required parameter

    public function dimensions(string $dimensions = null){
        $this->dimensions = (empty($dimensions)) ? '&dimensions=' . $dimensions : ''; 
        return $this;
    }


    // Input Parameter: Where is not required parameter

    public function where(string $where = null){ 
        $this->where = (empty($where)) ? '&where=' . $where : ''; 
        return $this;
    }

    // Limit is not a required parameter. It will default to 10 if not explicitly set.

    public function limit(int $limit = null){ 
        $this->limit = (empty($limit)) ? '&limit=' . $limit : ''; 
        return $this;
    }
    
    // Offset is not a required parameter.

    public function offset(int $offset = null){ 
        $this->offset = (empty($offset)) ? '&offset=' . $offset : ''; 
        return $this;
    }

    // Sort is not a required parameter.

    public function sort(string $sort = null){ 
        $this->sort = (empty($sort)) ? '&sort=' . $sort : ''; 
        return $this;
    }

    // Fields is not a required parameter.

    public function fields(string $fields = null){ 
        $this->fields = (empty($fields)) ? '&fields=' . $fields : ''; 
        return $this;
    }

    // Reconiled is not a required parameter.

    public function reconciled(string $reconciled = null){ 
        $this->reconciled = (empty($reconciled)) ? '&reconciled=' . $reconciled : ''; 
        return $this;
    }

    // From is not a required parameter.

    public function from(string $from = null){ 
        $this->from = (empty($from)) ? '&from=' . $from : ''; 
        return $this;
    }

    // To is not a required parameter.

    public function to(string $to = null){ 
        $this->to = (empty($to)) ? '&to=' . $to : ''; 
        return $this;
    }

    // This method is called in the background to create an authentication token.

    private function authenticate(){

         $auth_string = base64_encode(config('videocloudanalytics.api_key') . ':' . config('videocloudanalytics.api_secret'));

         $response = Http::withHeaders([
             'Content-Type' => 'application/x-www-form-urlencoded',
             'Authorization' => 'Basic ' . $auth_string,
         ])->post('https://oauth.brightcove.com/v4/access_token?grant_type=client_credentials');

         $response->throw();

         $access_token = $response->object()->access_token;
         $headers = array('Authorization' => ' Bearer ' . $access_token, 'content-type' => 'application/json');

         return $headers;
    }

    // This is where the actual call is made and it returns a Laravel Collection for your convenience.

    private function request($request){

        $headers = $this->authenticate();
        $response = Http::withHeaders($headers)->get($request);

        return $response->collect();

    }

}
