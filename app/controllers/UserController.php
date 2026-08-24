<?php

namespace app\controllers;
use app\core\InitController;
use app\models\UserModel;
use Couchbase\User;

class UserController extends InitController
{
    public function actionProfile() {
   echo "страница пользователя";
   var_dump($this->route);
    }

    public function actionRegistration() {
        $this->view->title = "Регистрация";
        $error_message = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $login = !empty($_POST["login"]) ? trim($_POST["login"]) : null;
            $password = !empty($_POST["password"]) ? trim($_POST["password"]) : null;
            $password_confirm = !empty($_POST["password_confirm"]) ? trim($_POST["password_confirm"]) : null;

            if (empty($login)) {
                $error_message .= "Введите логин <br>";
            }
            if (empty($password)) {
                $error_message .= "Введите пароль <br>";
            }
            if (empty($password_confirm)) {
                $error_message .= "Повторите пароль <br>";
            }
            if ($password != $password_confirm) {
                $error_message .= "Пароли не совпадают <br>";
            }

            if (empty($error_message)) {
                $user_model = new UserModel();
                $userId = $user_model->addNewUser($login, $password);
                if ($userId) {
                    $this->redirect("/user/profile");
                }
            }
        }

        $this->render("registration", [
            "error_message"=> $error_message,
        ]);

    }

}