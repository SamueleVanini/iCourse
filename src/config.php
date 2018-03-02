<?php

/*
define(DB_HOST, "5icbonavigo.tk");
define(DB_NAME, "icourse");
define(DB_USERNAME, "icourse");
define(DB_PASSWD, "haicourse");
*/

class Config
{
    protected $DB_HOST;
    protected $DB_NAME;
    protected $DB_USERNAME;
    protected $DB_PASSWD;

    public function load()
    {
        $str = file_get_contents("../config.json");
        $config = json_decode($str, true);
        $this->DB_HOST     = $config["DB_HOST"];
        $this->DB_NAME     = $config["DB_NAME"];
        $this->DB_USERNAME = $config["DB_USERNAME"];
        $this->DB_PASSWD   = $config["DB_PASSWD"];
    }
}