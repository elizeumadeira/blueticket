<?php

namespace App\DataBase;

use PDO;

class DB
{
    private $pdo;
    private static $instance = null;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new DB;
        }

        return self::$instance;
    }
    protected function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD);
            return $pdo;
        } catch (PDOException $e) {
            echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
        }
    }
    protected function __clone()
    {
    }

    public static function build_condition($values, $separator = ',')
    {
        $con = [];
        foreach ($values as $campo => $value) {
            $v;
            if ($value == '') {
                $v = "''";
            } elseif (is_null($value)) {
                $v = "null";
            } elseif ($value === 0) {
                $v = "0";
            } else {
                $v = "'".$value."'";
            }
            $con[] = $campo.'='.$v;
        }

        return implode($separator, $con);
    }

    public static function select($table, $conditions = false)
    {
        $sql = "SELECT * FROM ".$table;

        if (is_array($conditions)) {
            $sql .= ' WHERE ' . DB::build_condition($conditions);
        }

        $pdo = self::getInstance()->pdo;
        $result = $pdo->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function select_all($table, $conditions = false)
    {
        $sql = "SELECT * FROM ".$table;
        if (is_array($conditions)) {
            $sql .= ' WHERE ' . DB::build_condition($conditions);
        }
        $pdo = self::getInstance()->pdo;
        $result = $pdo->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insert($table, $values)
    {
        if (sizeof($values) == 0) {
            return false;
        }

        //faz o insert
        $sql = "INSERT INTO " . $table . " SET " . DB::build_condition($values);
        $pdo = self::getInstance()->pdo;
        $result = $pdo->query($sql);
        
        //recupera o id
        $pdo2 = self::getInstance()->pdo;
        $result = $pdo2->query('SELECT LAST_INSERT_ID() as id;');
        $id = $result->fetch(PDO::FETCH_ASSOC);

        return $id['id'];
    }

    public static function delete($table, $condition)
    {
    }

    public static function update($table, $values)
    {
    }

    public function get_evento_lista()
    {
        $sql = "SELECT 
                    evento.*,
                    count(opcao_evento.id) as qtd_opcoes
                FROM 
                    evento
                    left join opcao_evento on opcao_evento.id_evento = evento.id
                group by evento.id";

        $pdo = self::getInstance()->pdo;
        $result = $pdo->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_opcao_evento($id_evento)
    {
        $sql = "SELECT
                    id,
                    id_evento,
                    descricao,
                    lote,
                    valor,
                    qtd_max,
                    DATE_FORMAT(dia_inicio, '%Y-%m-%d') dia_inicio,
                    DATE_FORMAT(dia_fim, '%Y-%m-%d') dia_fim,
                    observacao
                FROM opcao_evento 
                WHERE id_evento=:id_evento";

        $pdo = self::getInstance()->pdo;
        $sth =  $pdo->prepare($sql);
        $sth->bindValue(':id_evento', $id_evento, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
