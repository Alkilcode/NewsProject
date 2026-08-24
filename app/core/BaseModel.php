<?php

namespace app\core;

use PDO;   //будем работать с классом PDO
use PDOException; //если будут ошибки, сможем обработать

abstract class BaseModel
{
protected $db;

public function __construct() {
    $config = require "app/config/db.php"; //будет брать данные из базы данных

    try {
        $this->db = new PDO (
            $config["provider"].":host=".$config["hostname"].";dbname=".$config["database"],
            $config["username"], $config["password"]
        );
    } catch (PDOException $e) {
        print "Ошибка " . $e->getMessage() . "<br/>";
       die();
    }
  }

  protected function query($sql, $params = [])  //вводим в терминал запрос, но не отправляем
  {
      $query = $this->db->prepare($sql);
      if (!empty($params)) {
          foreach ($params as $key => $value) {
              $query->bindValue(":". $key, $value);
          }
      }
      $query->execute();
      return $query;
  }

  protected function select($sql, $params = []) {
    $result = $this->query($sql, $params);
    return $result->fetchAll(PDO::FETCH_ASSOC); //получаем все данные ввиде ассоц. массива
  }

  protected function insert($sql, $params = []) {
        $this->query($sql, $params);
        return (int)$this->db->lastInsertId(); //возвращение идентификатора, который создается
    }
    protected function update($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->rowCount(); //получаем записи которые обновили
    }

    protected function delete($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->rowCount();
    }
}