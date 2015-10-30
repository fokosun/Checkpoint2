<?php

namespace Florence;

use Dotenv\Dotenv;

class EnvReader extends Dotenv
{
    public function __construct()
    {
        parent::__construct(__DIR__.'/../');
    }

    public function loadEnv()
    {
        $this->load();
    }
}
