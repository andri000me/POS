<?php
namespace Core\Rest;

class Curl {

    private $url = "";
    private $header = array();
    private $ch = false;
    private $result = false;
    private $body = false;

    public function __construct()
    {
        $this->ch = curl_init();
        
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false );
    }

    public function httpVersion($httpVsersion = CURL_HTTP_VERSION_1_1){
        curl_setopt($this->ch, CURLOPT_HTTP_VERSION, $httpVsersion);
    }

    public function method($method = "GET"){

        switch ($method){
            case "POST":
                curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST , "POST");
                curl_setopt($this->ch, CURLOPT_POST , true);
            case "PUT":
                curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST , "POST");
            case "DELETE":
                curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST , "DELETE");
            case "GET":
                curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST , "GET");
            default:
                curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST , "GET");

        }

    }

    public function maxRedirects($maxredirs){

        curl_setopt($this->ch, CURLOPT_MAXREDIRS  , $maxredirs);
        return $this;
    }

    public function url($url){
        $this->url = $url;
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        return $this;
    }

    public function addHeader($key, $value){
        $this->header[$key] = $value;
        return $this;
    }

    public function body($body){
        if(!$this->body)
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($body));
        return $this;
    }

    public function exec(){
        curl_setopt(
            $this->ch,  
            CURLOPT_HTTPHEADER,
            $this->header
        );

        $this->result = curl_exec($this->ch);
        return $this->result;
    }

    public function getError(){
        return curl_errno($this->ch);
    }

    public function close(){
        curl_close($this->ch);
    }

    public function timeout($timeout = 30){
        
        curl_setopt($this->ch, CURLOPT_TIMEOUT , $timeout);
        return $this;
    }

}