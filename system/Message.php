<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This class allow an user to send, receive and display
 * messages (the javascript will use this class eventually)
 * @author Thomas
 */
class Message {
    
    private static $model;
     
    private static $post;
     
    public static function loadModel($name) {
        /*
         * I didn't knew if I can use Auth::loadModel() or
         * if I have to make a function loadModel for Message
         * so I did this, uncomment this if it's ok or just resolved
         */ 
        $name = strtolower($name);
        $modelClass = $name . 'Model';
        $model = ROOT . 'app' . DS . 'models' . DS . $name . EXT;
        
        if(file_exists($model)) {
            require_once $model;
            self::$model = new $modelClass();
        }
    }
    
    public static function send($post){
        /*
         * This function clean a message (in case a mean user wants
         * to destroy our website :( ) and send it to the model to
         * save the message in the database.
         */
        
        self::loadModel('messages');
        
        if(is_numeric($post['idE']) && is_numeric($post['idR'])) {
            $message = $post['message'];
            $post['message'] = $message;
            self::$model->sendMessage($post);
            return TRUE;
        }
        
        return FALSE;
    }
    
    public static function receiveLastMessage($id1, $id2){   
        /*
        * This function return an array of the last  
        * message exchange between 2 users  
        */
        self::loadModel('messages');
        
        return self::$model->getLastMessage($id1, $id2);
    }
    public static function getArrayUser($id){
        self::loadModel('users');
        return self::$model->getUser($id);
    }
    public static function receiveConversation($id1, $id2, $limit = 10){
        /*
        * This function return an array of a conversation between 2 users
        * and an array of their firstname and lastname
        * with a defined limit of messages
        */
        self::loadModel('messages');
        
        $return['conversation'] = self::$model->getConversation($id1, $id2, $limit);
        
        foreach($return['conversation'] as $key => $message)
        {
            if($return['conversation'][$key]['idR'] == $_SESSION['user']['id'])
            {
                $temp = Message::getArrayUser($_SESSION['user']['id']);
                $RSA = new RSA();
                $RSA->setPrivateKey($temp['private_key']);
                $RSA->setModulus($temp['modulus']);
                $message = $RSA->decrypt($return['conversation'][$key]['message']);
                $return['conversation'][$key]['message'] = $message;
            }
                
        }
            
        
        self::loadModel('users');
        
        $return[$id1] = self::$model->getUser($id1);
        $return[$id2] = self::$model->getUser($id2);
        
        return $return;
    }
    public static function createOrShowConvers($idE, $idR){
        self::loadModel('messages');
        
        $convers = self::$model->getConversation($idE, $idR, 1);

        $_SESSION['idR'] = $idR;

    }
    public static function listConversations($id){
        
        self::loadModel('messages');
        return self::$model->getConversationList($id);
    }
}
