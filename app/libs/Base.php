<?php

class Base 
{

    private $host = DB_HOST;
    private $dbname = DB_NAME;
    private $user = DB_USER;
    private $password =DB_PASS;

    private $dbh;
    private $stat;
    private $error;

    public function __construct()
    {
        $dns = 'mysql:host=' . $this->host .';dbname=' . $this->dbname;

        $option = [
            PDO::ATTR_ERRMODE => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try{
            $this->dbh = new PDO($dns, $this->user, $this-> password, $option);
            $this->dbh->exec('set names utf8');
        }catch(\PDOException $e) {
            $this->error = $e -> getMessage();
            echo $this->error;
        }
    }

    
    public function query($sql)
    {
        $this->stat = $this->dbh->prepare($sql);
    }

    private function bind($parametro, $valor, $tipo = null)
    {
        if(is_null($tipo)){
            switch(true){
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                    break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                    break;
                case is_null($valor):
                    $tipo = PDO::PARAM_NULL;
                    break;
                default:
                    $tipo = PDO::PARAM_STR;
                    break;
            }


        }

        return $this->stat->bindValue($parametro,$valor,$tipo);
    }

    public function execute()
    {
        return $this->stat = $this->execute();
    }

    public function registers()
    {
        $this->execute();
        return $this->stat->fetchAll(PDO::FETCH_OBJ);
    }

    public function register()
    {
        $this->execute();
        return $this->stat->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount()
    {
         $this->execute();
        return $this->stat->rowCount();
    }


}