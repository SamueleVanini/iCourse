<?php

class Config
{
    protected $DB_HOST;
    protected $DB_NAME;
    protected $DB_USERNAME;
    protected $DB_PASSWD;

    public function load()
    {
        $var = $_SERVER['DOCUMENT_ROOT']."/iCourse/config.json";
        $str = file_get_contents($var);
        $config = json_decode($str, true);
        $this->DB_HOST     = $config["DB_HOST"];
        $this->DB_NAME     = $config["DB_NAME"];
        $this->DB_USERNAME = $config["DB_USERNAME"];
        $this->DB_PASSWD   = $config["DB_PASSWD"];
    }
}