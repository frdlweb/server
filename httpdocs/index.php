<?php
/**
* continue with webfat...
*/
register_shutdown_function(function($appId, $url){
 $code= file_get_contents($url);

 $success = false;	
 if(is_string($code)){
   $code = str_replace("/****'appId'=>'@@@APPID@@@',*****/", '\'appId\'=>\''.$appId.'\',', $code);	
   $code = str_replace('/****$configVersion[\'appId\']=\'@@@APPID@@@\';*****/', '$configVersion[\'appId\']=\''.$appId.'\';', $code);	
   $success = file_put_contents(__DIR__.\DIRECTORY_SEPARATOR.'installer.php', trim($code));
 }
	
 if(false===$code || false === $success){
   throw new \Exception(sprintf('Could not install initial index, see %s', $url)); 
 }else{
  
 }
}, 'webfan/website', 'https://packages.frdl.de/raw/webfan/website/installer.php?cache-bust='.time());

ignore_user_abort(true);
header("Refresh:5; url=./installer.php?start=1");
header('Connection: close') ;
echo '<h1>Setup</h1><p class="btn-warning" style="color:red;background:url(https://io4.xyz.webfan3.de/assets/ajax-loader_2.gif) no-repeat;">Updating</p><p>Page will reload soon, please wait...!<br />Preparing for extracting the archive...</p>';
flush();
exit;
	
