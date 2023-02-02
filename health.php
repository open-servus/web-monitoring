<?php

$url_var = "http://example.com";

function get_contents($url_var) {
  get_headers($url_var);
  var_dump($http_response_header);
}

function get_http_response($url_var) {
    $ch = curl_init($url_var);
    curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
    curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT,10);
    $output = curl_exec($ch);
    print curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
}

if(file_exists('data.json'))
{
	$filename = 'data.json';
	$data = file_get_contents($filename); //data read from json file
	$urls = json_decode($data, true);  //decode a data

    foreach ($urls as $website_urls) {
        foreach ($website_urls as $url ) {
            get_contents($url['url']);
            #get_http_response($url['url']);
            echo "\n";
        }
    }
}else{
	 $message = "<h3 class='text-danger'>JSON file Not found</h3>";
}
?>