<?php

namespace Florence;

interface ModelInterface
{
    public function save();
    public static function find($row);
    public function update($id);
    public static function getAll();
    public static function destroy($row);
}