<?php
namespace MyApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use PDO;

include __DIR__ . '/../connect.php';

class Chat implements MessageComponentInterface {
    protected $connections;

    public function __construct() {
        $this->connections = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the connection object
        $this->connections->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        global $con;
        $message = json_decode($msg, true);
        // Process the received message
        $iduser = $message['userid'];//$_GET['userid'];
        
        // Your existing MySQL query
        $stmt = $con->prepare("
            SELECT 
                CASE
                    WHEN userone_id = :iduser THEN usertwo_id
                    ELSE userone_id
                END AS other_user_id,
                CASE
                    WHEN userone_id = :iduser THEN usertwo_username
                    ELSE userone_username
                END AS other_username,
                CASE
                    WHEN userone_id = :iduser THEN usertwo_image
                    ELSE userone_image
                END AS other_image,
                friends_id,
                last_message,
                message_time,
                message_sender,
                message_view
            FROM friends_with_messages
            WHERE (userone_id = :iduser OR usertwo_id = :iduser) AND approve = 1
            ORDER BY message_time DESC
        ");
        
        // Execute the query and fetch the data
        $stmt->bindParam(':iduser', $iduser);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        
        // Prepare the response
        if ($count > 0) {
            $response = json_encode(array("status" => "success", "data" => $data));
        } else {
            $response = json_encode(array("status" => "failure"));
        }
        
        // Send the response to the client who sent the message
        $from->send($response);
        
        // Broadcast the response to all connected clients
        foreach ($this->connections as $connection) {
            if ($connection !== $from) {
                $connection->send($response);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // Remove the connection object
        $this->connections->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        // Handle errors
        $conn->close();
    }
}