<?php /** @noinspection PhpComposerExtensionStubsInspection */

namespace App\Http\Controllers;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketController extends Controller implements MessageComponentInterface
{
    protected $clients;
    private $mEventsController;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->mEventsController = new EventsController();
    }

    /**
     * When a new connection is opened it will be passed to this method
     * @param  ConnectionInterface $conn The socket/connection that just connected to your application
     * @throws \Exception
     */
    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
    }

    /**
     * This is called before or after a socket is closed (depends on how it's closed).  SendMessage to $conn will not result in an error if it has already been closed.
     * @param  ConnectionInterface $conn The socket/connection that is closing/closed
     * @throws \Exception
     */
    function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
    }

    /**
     * If there is an error with one of the sockets, or somewhere in the application where an Exception is thrown,
     * the Exception is sent back down the stack, handled by the Server and bubbled back up the application through this method
     * @param  ConnectionInterface $conn
     * @param  \Exception $e
     * @throws \Exception
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "$e\n";
        $conn->close();
    }

    /**
     * Triggered when a client sends data through the socket
     * @param  \Ratchet\ConnectionInterface $conn The socket/connection that sent the message to your application
     * @param  string $msg The message received
     * @throws \Exception
     */
    function onMessage(ConnectionInterface $conn, $msg)
    {
        /** @noinspection PhpComposerExtensionStubsInspection */
        $event = json_decode($msg);
        $this->mEventsController->onNewEvent($event, function ($person, $roomId,$alert) {
            $res = json_encode(["person" => $person, "room" => $roomId,"type"=>"position"]);
            foreach ($this->clients as $client) {
                $client->send($res);
                if ($alert != null) {
                    $client->send(json_encode(["person" => $person, "room" => $roomId,"type"=>"alert"]));
                }
            }
        });
    }
}
