<?php
/*
 * an abstract class responsible for connection to database and setting db property, so the child classes will have connection in db property
 */
abstract class baseModel
{
    private static $instance = NULL;

    public $db;

    public function __construct()
    {
        $this->db = self::dbInstance();
    }

    public static function dbInstance()
    {
        if(self::$instance === NULL)
        {
            self::$instance = new PDO("mysql:host=localhost;dbname=quantox_test", "root", "root");
            self::$instance-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$instance;
    }
}

