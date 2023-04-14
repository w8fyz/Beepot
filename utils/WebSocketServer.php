<?php

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/vendor/autoload.php";
class WebSocketServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Nouvelle connexion ouverte
        $this->clients->attach($conn);
        echo "Nouvelle connexion! ({$conn->resourceId})\n";
    }


    public function onMessage(ConnectionInterface $from, $msg) {
        // Un message a été reçu
        foreach ($this->clients as $client) {
            if ($client !== $from) {
                // Envoi du message à tous les autres clients
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // Connexion fermée
        $this->clients->detach($conn);
        echo "Connexion fermée! ({$conn->resourceId})\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        // Erreur survenue
        echo "Erreur: {$e->getMessage()}\n";
        $conn->close();
    }
}
