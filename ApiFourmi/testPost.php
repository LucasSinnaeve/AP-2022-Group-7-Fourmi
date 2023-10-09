<?php
$url = "http://apifourmiloc.test/localisation.php";
$data = array('longitude' => 'testLongitude', 'latitude' => 'testLatitude', 'codeEquipe' => 'K');
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
$response = curl_exec($ch);

var_dump($response);

if (!$response)
{
    return false;
}