<?php

/**
 * Keys for RSA
 * @author Loick Mahieux
 * @modified Modelisation du #SWAG ©
 * @date 26/09/14
 */
 
$other;
class Keys {
    /**
     * prime number 1
     * @var integer
     */
    private $p;
    
    /**
     * prime number 2
     * @var integer
     */
    private $q;
    
    /**
     * modulus
     * @var integer
     */
    private $n;
    
    /**
     * (p-1)(q-1)
     * @var interger
     */
    private $phi;
    
    /**
     * encryption exponent
     * @var integer
     */
    private $e;
        
    /**
     * decryption exponent
     * @var integer
     */
    private $d;
    
    /**
     * RSAMathsTools class
     * @var RSATools
     */
    private $mathsTools;
    

    
    /**
     * Keys constructor
     */
    function __construct() {
        $this->mathsTools = new RSAMathsTools();
    }
    
    public function get() {
        return array(
            'public'    =>      $this->e,
            'private'   =>      $this->d,
            'modulus'   =>      $this->n
        );
    }
        
    /**
     * get public key
     * @return integer
     */
    public function getPublicKey() {
        return $this->e;
    }
    
    /**
     * get private key
     * @return integer
     */
    public function getPrivateKey() {
        return $this->d;
    }
    
    /**
     * get modulus
     * @return integer
     */
    public function getModulus() {
        return $this->n;
    }
    
    public function getPhi() {
        return $this->phi;
    }
    
        /**
     * generate keys
     * @param integer $length key length in bits
     */
    public function generate($length = 16) {
        //set length of the key
        $pLength = (int) ($length + 1) / 2;
        $qLength = $length - $pLength;
        
        //generate distinct prime numbers
        while($this->p == $this->q) {
            $this->p = $this->mathsTools->generatePrime($pLength);
            $this->q = $this->mathsTools->generatePrime($qLength);
        }
        
        //calculate modulus
        $this->n = $this->mathsTools->mul($this->p, $this->q);
        
        //calculate phi
        $this->phi =  $this->mathsTools->mul($this->p - 1, $this->q - 1);
        
        /*generate e
        do{
            $min = ($this->p < $this->q) ? $this->q : $this->p;
            $this->e = rand($min + 1,  ($this->phi)-1);
        }while($this->mathsTools->isCoprime($this->e,  $this->n));
        */
        //calculate d
        do{
        
         do{
            $min = ($this->p < $this->q) ? $this->q : $this->p;
            $this->e = rand($min + 1,  ($this->phi)-1);
        }while($this->mathsTools->isCoprime($this->e,  $this->n));
        
        $this->d = $this->mathsTools->invert($this->e, $this->phi);
        
       
        }while($this->d == 0);
        
    }
}

