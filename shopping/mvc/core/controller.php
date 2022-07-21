<?php
class controller
{
    function view($view, $data = [])
    {
        require_once "./mvc/views/" . $view . ".php";
    }
    function models($models)
    {
        require_once "./mvc/models/" . $models . ".php";
        return new $models;
    }
    function helper($helper)
    {
        require_once "./mvc/helper/" . $helper . ".php";
        return new $helper;
    }
    function viewFrontEnd($view, $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        require_once "./mvc/views/" . $view . ".php";
    }
}
