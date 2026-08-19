<?php

namespace app\core;

class Router
{
    protected $params = [];

    public function match(){
        $url = trim($_SERVER['REQUEST_URI'], "/");
        if (!empty($url)) {
            $params = explode("/", $url);
            if (!empty($params[0]) && !empty($params[1])) {   //если url не пустой, то обращение к контроллеру [0] и странице [1]
                $this->params = [
                    "controller" => $params[0],
                    "action" => $params[1]
                    ];
            } else {
                return false;
            }
        } else {
            $params = require "app/config/params.php";
            $this->params = [
                "controller" => $params["defaultController"],
                "action" => $params["defaultAction"],
            ];
        }
        return true;
    }
    public function run(){   //стартовая функция запускается при старте приложения
        if ($this->match()) {
            $path_controller = "app\\controllers\\". ucfirst($this->params['controller']). "Controller";
            if (class_exists($path_controller)) {
                $action ="action". ucfirst($this->params['action']);
                if (method_exists($path_controller, $action)) {
                    $controller = new $path_controller($this->params);
                    $controller->$action();
                } else {
                    echo "Action does not exist". $action;
                }
            } else {
                echo "Class does not exist". $path_controller;
            }
        } else {
            echo "Не найдено";
        }
    }
}