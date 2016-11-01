<?php
ini_set("display_errors","0");
error_reporting(!E_WARNING);
ini_set("default_socket_timeout",$timeout);
$timeout =  1000; // socket timeout
$addr = $argv[1] or die($argv[0]." ipaddr port (--ssl)");
$port = $argv[2] or die($argv[0]." ipaddr port (--ssl)");
$ssl = $argv[3] or 0; // does script use ssl? 
$count = 0;
echo "Port ping to {$addr} on {$port} ";
if ($ssl == "--ssl") echo "(with SSL handshake) ";
echo "started.".PHP_EOL;
$addr = ($ssl=="--ssl")?"tls://{$addr}":$addr;
while(-1) {
        $starttime = microtime(true);
        if(fsockopen($addr,$port)) {
        		$time = (microtime(true) - $starttime) * 1000;
            echo "Reply from {$addr} (time: {$time} ms)".PHP_EOL;
        }
        else {
            echo "Timed out from {$addr} (port: {$port})".PHP_EOL;
        }
        sleep(1);
}
?>
