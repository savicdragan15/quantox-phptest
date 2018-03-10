<?php
/*
 * an abstract class responsible for setting $models array and obligates child classes to implement index method
 */
abstract class baseController
{
    protected $models = array();

    public function setModel($name,$value)
    {
        $this->models[$name] = $value;
    }

    abstract public function index();
}

