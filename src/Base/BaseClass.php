<?php

namespace Florence;
use PDO;

class BaseClass {
    use Connection;

    public function createTable(){
        $table = strtolower(end(explode('\\', get_called_class())));
   
    }

}


