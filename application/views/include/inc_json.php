<?php

$url = 'https://nepse-data-api.herokuapp.com/data/todaysprice'; 

class JsonWrapper {

  public function loadJSON($url) {
    if (ini_get('allow_url_fopen') == true) {
      return $this->load_fopen($url);
    } else if (function_exists('curl_init')) {
      return $this->load_curl($url);
    } else {
      // Enable 'allow_url_fopen' or install cURL.
      throw new Exception("Can't load data.");
    }
  }

  public function load_curl($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($result);
    return $data;
  }

}




$aa = new JsonWrapper();

$aa->loadJSON($url);
$data = $aa->load_curl($url);



//$url = 'https://nepse-data-api.herokuapp.com/data/todaysprice'; // path to your JSON file
//$raw = file_get_contents($url); // put the contents of the file into a variable
//$data = json_decode($raw);
 ?>