<?php

namespace app\models;
use app\core\BaseModel;

class UserModel extends BaseModel
{
public function addNewUser($login, $password)
{
   $password = password_hash($password, PASSWORD_DEFAULT);

   return $this->insert(
     "INSERT INTO users (login, password) VALUES (:login, :password)", //:login :password - алиасы
     [
         ":login" => $login,
         ":password" => $password
     ]
   );
  }
}