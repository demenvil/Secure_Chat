<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author loick
 */
class usersModel {
    const TABLE = 'users';
    
    /**
     * get all infos for one user
     * @param integer $id
     * @return array user infos
     */
    public function getUser($id) {
        $sql = 'SELECT * '
                . 'FROM ' . self::TABLE . ' '
                . 'WHERE id = ?';
        
        return Database::execute($sql, array($id))->fetch();
    }
    
    public function getUserConnect($username, $password) {
        $sql = 'SELECT id, lastname, firstname '
                . 'FROM ' . self::TABLE . ' '
                . 'WHERE username = ? '
                . 'AND password = ?';
        
        return Database::execute($sql, array($username, sha1($password)))->fetch();
    }
    
    public function getUserByName($username){
        $username = $username . '%';
        $sql = 'SELECT id, firstname, lastname '
                . 'FROM ' . self::TABLE . ' '
                . 'WHERE username LIKE ? ';
        
        return Database::execute($sql, array($username))->fetchAll();
    }
    
    public function addUser($username, $firstname, $lastname, $password, $public_key, $private_key, $modulus){
         $sql = 'INSERT INTO users (`username`, `firstname`, `lastname`, `password`, `public_key`, `private_key`, `modulus`) 
                 VALUES (?,?,?,?,?,?,?)';
        if(Database::execute($sql, array($username, $firstname, $lastname, $password, $public_key, $private_key, $modulus)))
            return true;
        return false;
    }
    /**
     * get all users' id
     * @return array users' id
     */
    public function getAll() {
        $sql = 'SELECT id '
                . 'FROM ' . self::TABLE;
        
        return Database::execute($sql)->fetchAll();
    }
}
