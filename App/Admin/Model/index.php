<?php
require 'vendor/autoload.php';
use QL\QueryList;
$hj = QueryList::Query('http://mobile.csdn.net/',array("url"=>array('.unit h1 a','href')));
$data = $hj->getData(function($x){
    return $x['url'];
});
print_r($data);

?>