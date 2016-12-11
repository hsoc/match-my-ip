<?php

// grabs an ip list and matches your ip against it.

// http://stackoverflow.com/a/2031935/3774311
function get_ip_address(){
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $ip){
                $ip = trim($ip); // just to be safe

                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                    return $ip;
                }
            }
        }
    }
}

// create curl resource 
$ch = curl_init();

// set url 
curl_setopt($ch, CURLOPT_URL, "url/iplist.txt");

//return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

// $output contains the output string 
$iplist = curl_exec($ch);

// close curl resource to free up system resources 
curl_close($ch);
$myip = get_ip_address();

http://stackoverflow.com/a/4366748/3774311
if (strpos($iplist, $myip) !== false) {
    echo 'true', PHP_EOL;

}

?>
