<?php

namespace Florence;

/**
* static methods for the Model Class
**/

interface ModelInterface
{
    public function save();
    public static function find($row, $value);
    public static function getAll();
    public static function destroy($row);
}
