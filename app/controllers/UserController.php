<?php

namespace app\controllers;
use app\core\InitController;

class UserController extends InitController
{
    public function actionProfile() {
   echo "страница пользователя";
   var_dump($this->route);
}
}