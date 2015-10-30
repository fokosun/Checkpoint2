<?php

namespace Florence;


class User extends Base{

    public function hello()
    {
        echo "chinedu";
    }

}

$new = new User;
$new->hello();
