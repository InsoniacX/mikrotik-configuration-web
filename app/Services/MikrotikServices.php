<?php

namespace App\Services;

class MikrotikServices
{

    protected $host;
    protected $username;
    protected $password;
    /**
     * Create a new class instance.
     */
    public function __construct($host, $username, $password)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect()
    {
        //
    }

    public function getInterface()
    {
        // 
    }
}
