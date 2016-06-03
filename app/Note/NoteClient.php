<?php
/**
 * Created by PhpStorm.
 * User: lackhurt
 * Date: 16/5/29
 * Time: 下午6:51
 */

namespace App\Note;


use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class NoteClient
{

    const FETCH_NOTEBOOK_QUEUE = 'fetch-notebooks';

    private $connection;
    private $channel;
    private $callback_queue;
    private $response;
    private $corr_id;


    public function __construct() {
        $this->connection = new AMQPStreamConnection(
            'localhost', 5672, 'user', 'user');
        $this->channel = $this->connection->channel();
        list($this->callback_queue, ,) = $this->channel->queue_declare(
            "", false, false, true, false);
        $this->channel->basic_consume(
            $this->callback_queue, '', false, false, false, false,
            array($this, 'on_response'));
    }


    public function on_response($rep)
    {
        if ($rep->get('correlation_id') == $this->corr_id) {
            $this->response = $rep->body;
        }
    }

    public function call($n)
    {
        $this->response = null;
        $this->corr_id = uniqid();

        $msg = new AMQPMessage(
            (string)$n,
            array('correlation_id' => $this->corr_id,
                'reply_to' => $this->callback_queue)
        );
        $this->channel->basic_publish($msg, '', self::FETCH_NOTEBOOK_QUEUE);
        while (!$this->response) {
            $this->channel->wait();
        }
        return intval($this->response);
    }

    public function fetchNotebooks($accessToken) {
        $this->response = null;
        $this->corr_id = uniqid();

        $msg = new AMQPMessage(
            (string)$accessToken,
            array('correlation_id' => $this->corr_id,
                'reply_to' => $this->callback_queue)
        );
        $this->channel->basic_publish($msg, '', self::FETCH_NOTEBOOK_QUEUE);
        while (!$this->response) {
            $this->channel->wait();
        }
        return $this->response;
    }
}