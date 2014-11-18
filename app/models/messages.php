<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * messagesModel is the class for treating the messages 
 * in the database (pretty obvious isn't it ?)
 * @author Thomas
 */
class messagesModel {
    const TABLE = 'messages';
    
    /**
     * Get all the messages between 2 users
     * with a limit of $limit messages
     * we don't know who's the receiver nor the sender
     */
    public function getConversation($id1, $id2, $limit) {
        // PDO works badly with bindvalues in limit
        // so before we find a way, I put this.
        $sql = 'SELECT idE, idR, message, date '
                . 'FROM ' . self::TABLE . ' '
                . 'WHERE idE = ?'
                . 'AND idR = ?'
                . 'OR idE = ?'
                . 'AND idR = ?'
                . 'ORDER BY date ASC '
                . 'LIMIT 0, ' .intval($limit). '';

        return Database::execute($sql, array($id1, $id2, $id2, $id1))->fetchAll();
    }
    
    /*
     * Insert a message in the database
     */
    public function sendMessage($post = array()){
       $sql = 'INSERT INTO ' . self::TABLE . ' '
                . 'VALUES (?, ?, ?, ?)';
        
        Database::execute($sql, array($post['idE'], $post['idR'], $post['message'], time()));
    }
    
    /*
     * Get the last message of a conversation
     */
    public function getLastMessage($id1, $id2){
         $sql = 'SELECT idE, idR, message, date '
                . 'FROM ' . self::TABLE . ' '
                . 'WHERE idE = ?'
                . 'AND idR = ?'
                . 'OR idE = ?'
                . 'AND idR = ?'
                . 'ORDER BY date DESC'
                . 'LIMIT 1';
        
        return Database::execute($sql, array($id1, $id2, $id2, $id1))->fetch();
    }
    
    public function getConversationList($id){ 
        $sql = 'SELECT DISTINCT idR, idE '
                . 'FROM ' . self::TABLE . ' '
                . 'WHERE idE = ? '
                . 'OR idR = ?';

        return Database::execute($sql, array($id, $id))->fetchAll();
    }
    
}