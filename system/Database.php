<?php

/**
 * Database PDO
 */
class Database {
    /**
     * @var PDO
     */
    private static $pdo = null;
    
    private static function init(){
        self::$pdo = new PDO(
                'mysql:host='.DBHOST.';dbname='.DBNAME,
                DBUSER,
                DBPASS,
                array(
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                )
        );
    }
    
    /**
     * 
     * @param string $query
     * @return PDOStatement
     */
    public static function query($query){
        if(self::$pdo === null)
            self::init ();
        
        return self::$pdo->query($query);
    }
    
    /**
     * @param string $query
     * @return PDOStatement
     */
    public static function prepare($query){
        if(self::$pdo === null)
            self::init ();
        
        return self::$pdo->prepare($query);
    }
    
    /**
     * @param string $query
     * @param mixed $params
     * @return PDOStatement
     */
    public static function execute($query, $params = array()){
        if(self::$pdo === null)
            self::init ();
        
        $stmt = self::$pdo->prepare($query);
        
        if(!is_array($params)){
            $params = func_get_args();
            array_shift($params);
        }
        
        try{
            $stmt->execute($params);
        }catch(Exception $e){
            exit($e);
        }
        
        return $stmt;
    }
}