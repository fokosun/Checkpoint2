<?php

namespace Florence;

/**
 * Static methods for the Model Class
**/

interface ModelInterface
{
    /**
     * @param $row
     * @param $value
     *
     * @return mixed
     */
    public static function find($row, $value);

    /**
     * @return mixed
     */
    public static function getAll();

    /**
     * @return mixed
     */
    public static function destroy($row);
}
