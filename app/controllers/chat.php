<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * This controller use the ajax part of the chat
 * to send and receive messages
 * @author Thomas
 *  
 */
class chatController extends Controller{
    public function index(){
        if(!Auth::isConnected()) {
            Popup::set('ERREUR', 'Vous n\'etes pas connecté', 'error');
            $this->redirect('home');
        }
        $vars['id1'] = $_SESSION['user']['id'];
                                           
        if(isset($_SESSION['idR']) && !empty($_SESSION['idR'])){
            $vars['id2'] = $_SESSION['idR'];
            $vars['messages'] = Message::receiveConversation($vars['id1'], $vars['id2'], 100);
        }
        $this->setParams($vars);
        $this->loadView('chat');
        
        $this->view->render();
    }
    public function sendMessage(){
        
        
        /* We check if the user is connected
         * otherwise it is impossible to send 
         * a message
         */
        if(Auth::isConnected()){
            $input = new Input();
            $post['message'] = $input->post('message');
            $post['message'] = utf8_encode($post['message']);
            // We assume that we have the receiver id via $_POST
            $post['idR'] = $input->post('idR');
            $post['idE'] = $_SESSION['user']['id'];
            
            $user = Message::getArrayUser($post['idR']);
            $rsa = new RSA();
            $rsa->setModulus($user['modulus']);
            $rsa->setPublicKey($user['public_key']);
            
            $post['message'] = $rsa->encrypt(str_split($post['message']));
            
            Message::send($post);
            
            /* 
            *  The user will not leave the chat 
            *  but he will see his message thanks to AJAX)
            *  for now, I don't know how to load messages
            *  without recharching the whole page with render()
            *  so I let this until we find a way.
            */
            $this->loadView('chat'); 
            $this->view->render();
        } else {
            // We redirect the user in the homepage
            Popup::set('ERREUR', 'Vous n\'etes pas connecté', 'error');
            $this->loadView();
            $this->view->render();
        }
    }
    public function selectConvers(){
        
       $input = new Input();
       $post['idR'] = $input->post('idR');
        
        Message::createOrShowConvers($_SESSION['user']['id'], $post['idR']);
        
        $this->loadView('chat');
        $this->view->render();
    }
    public function listerConvers(){
        return Message::listConversations($_SESSION['user']['id']);
    }
    
    public function searchUser(){
        $input = new Input();
        $post['username'] = $input->post('username');
        
        User::getUserByName($post['username']);
        
        $this->loadView('chat');
        $this->view->render();
    }
}
