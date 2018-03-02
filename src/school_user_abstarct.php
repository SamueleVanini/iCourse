<?php

require_once("user_abstract");

abstract class SchoolUser extends User
{
    private $course_list = [];
    private $class = [];

    /**
     * Recupera la lista dei corsi di un utente
     */
    public function get_course_list() {}

    /**
     * Rcupera la lista delle classi a cui si appartiene (1 se studente, 1+ se professore)
     */
    public function get_class() {}

    /**
     * Setta la lista dei corsi di un utente
     */
    public function add_course() {}

    /**
     * Setta la lista dei corsi di un utente
     */
    public function remove_course() {}

    /**
     * Setta la lista delle classi a cui si appartiene (1 se studente, 1+ se professore)
     */
    public function add_class() {}

    /**
     * Setta la lista delle classi a cui si appartiene (1 se studente, 1+ se professore)
     */
    public function remove_class() {}
}