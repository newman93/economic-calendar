<?php
    namespace App\Services;

    class ApiService {
        private $client;
        private $url;
    
        public function __construct($client) {
            $this->client = $client;
            $this->url = $_ENV['API_URL'];
        }

        public function getData($from, $to) {
            $urlPath = $this->url.'&from='.date("Y-m-d", strtotime($from)).'&to='.date("Y-m-d", strtotime($to));
            
            $response = $this->client->request('GET', $urlPath);

            return [($response->getStatusCode()  == 200) ? $response->getContent() : '',  $response->getStatusCode()];
        }
    }