<?php
namespace NoFlo;

use Evenement\EventEmitter;

class InternalSocket extends EventEmitter implements SocketInterface
{
    private $connected = false;
    private $from = array();
    private $to = array();

    public function getId()
    {
        if ($this->from && !$this->to) {
            return "{$this->from->process->id}.{$this->from->port}:ANON";
        }
        if (!$from) {
            return "ANON:{$this->to->process->id}.{$this->to->port}";
        }
        return "{$this->from->process->id}.{$this->from->port}:{$this->to->process->id}.{$this->to->port}";
    }

    public function connect()
    {
        $this->connected = true;
        $this->emit('connect', array('socket' => $this));
    }

    public function send($data)
    {
        $this->emit('data', array('data' => $data));
    }

    public function disconnect()
    {
        $this->connected = false;
        $this->emit('disconnect', array('socket' => $this));
    }

    public function isConnected()
    {
        return $this->connected;
    }
}