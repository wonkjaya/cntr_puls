<?php
function baseUrlCounter($type,$object){
 if($type=="css"){
   $url=base_url('assets/css-style/'.$object);
 }elseif($type=="js"){
   $url=base_url('assets/js-script/'.$object);
 }elseif($type=="image"){
   $url=base_url('assets/img/'.$object);
 }
 return $url;
}

function siteUrlCounter($method,$query=''){
 if($query == ""){
   $site=site_url('pulsa/'.$method);
 }else{
   $site=site_url('pulsa/'.$method).'?'.$query;
 }
 return $site;
}


?>
