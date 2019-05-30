<?php

namespace App\Extra;


class GooglePositionFinder {

    private $url;
    private $keyword;
    private $country;
    private $domain;
    private $links;
    private $position;

    public function __construct(){
        $this->position = 1;
    }

    public function get($keyword,$country, $domain){
        $this->keyword = rawurlencode($keyword);
        $this->domain = $domain;
        $this->country = $country;
        return $this->query();
    }

    private function query(){
        $this->setUrl();
        $this->getLinks();
        return $this->find();

    }

    private function setUrl(){
        $this->url = "https://www.google." .$this->country . "/search?q=" . $this->keyword . "&start=" .$this->position ;
    }

    private function getLinks(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch,CURLOPT_REFERER,"https://www.google." . $this->country);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        curl_close($ch);
        $data = preg_replace("<<b>>","",$data);
        $data = preg_replace("<</b>>","",$data);
        preg_match_all('/<h3 class="r"><a href=\"(.+?)\">(.+?)<\/a><\/h3>/', $data, $answer);
        $this->links = $answer[1];

    }


    private function find(){
        for ($i = 0; $i < count($this->links); $i++){
            if(strpos($this->links[$i],$this->domain . "/" ) !== false){
                return $i + $this->position;
            }
            if($i == count($this->links) - 1){
                $this->position += count($this->links);
                return $this->query();
            }
        }
    }


}
