<?php
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Server\IoServer;

$fp = @fsockopen("localhost", 8338, $errno, $errstr, 1);
if ($fp !== false) {
    echo "!= FALSE!!";
    fclose($fp);
    return;
}

require 'WebSocketServer.php';
try {
    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new WebSocketServer()
            )
        ),
        8338
    );

    echo "Serveur WebSocket démarré\n ".$errstr;

    $server->run();
} catch (Exception $e) {
    echo $e;
}