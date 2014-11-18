<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author loick
 */
class homeController extends Controller {
    private $model;

    public function index() {
        if(Auth::isConnected())
            $this->redirect ('chat');
        $this->loadView();
        $this->view->render();
    }
    
    public function forget() {
        if(Auth::isConnected())
            $this->redirect ('chat');
        $this->loadView();
        $this->view->render('forget');
    }
    
    public function signin() {
        if(Auth::isConnected())
            $this->redirect ('chat');

        if (Input::post('nom') != null && Input::post('prenom') != null && Input::post('mail') != null && Input::post('pseudo') != null && Input::post('pass') != null && Input::post('pass2') != null) 
        {
            $passe = Input::post('pass');
            $passe2 = Input::post('pass2');

            if ($passe == $passe2) 
            {
                $pseudo = Input::post('pseudo');
                $email = Input::post('mail');

                $passe = sha1($passe);
                $a = new Keys;
                $a->generate();
                $pubkey = $a->getPublicKey();
                $prikey = $a->getPrivateKey();
                $mod = $a->getModulus();
                
		require 'app/models/users.php';
		$model = new usersModel();
                $model->addUser($pseudo,Input::post('prenom'),Input::post('nom'),$passe,$pubkey,$prikey,$mod);

                Popup::set("Inscription terminée",'success');
                $this->loadView();
                $this->view->render();
            }
            else
            {
                Popup::set("Les mots de passe ne corresponde pas.",'error');
                $this->loadView();
                $this->view->render('signin');
            }
        }
        elseif (Input::post('submit') == 'Inscription' && (Input::post('nom') == null || Input::post('prenom') == null || Input::post('mail') == null || Input::post('pseudo') == null || Input::post('pass') == null || Input::post('pass2') == null))
        {
            Popup::set("Tout les champs doivent être completés.",'error');
            $this->loadView();
            $this->view->render('signin');
        }
        else{
            $this->loadView();
            $this->view->render('signin');
        }

    }
        
    
    public function login() {
        if(Input::post('login') != NULL && Input::post('password') != NULL) {
            $post['login'] = Input::post('login');
            $post['password'] = Input::post('password');         

            if (Auth::connect($post['login'], $post['password'])) {
                Popup::set('REUSSI', 'bravo', 'success');
                $this->redirect('chat');
            } 
            else {
                Popup::set('ERREUR', 'identifiants non valides', 'error');
                $this->loadView();
                $this->view->render();
            }
        }else
            $this->redirect('home');
    }
    
    public function logout() {
        if(Auth::isConnected())
            Auth::logout();
        $this->redirect('home');
    }
}
