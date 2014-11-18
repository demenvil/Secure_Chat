<?php

/**
 * RSA encrypt and decrypt class
 * @author Loick Mahieux
 * @modified Modelisation du #SWAG ©
 * @date 26/09/14
 */
 
class RSA {
    /**
     * modulus
     * @var integer
     */
    private $modulus;
    
    /**
    *	Phi
    *
    */
    private $phi;
    
    /**
     * public key
     * @var integer
     */
    private $public_key;
    
    /**
     * private key
     * @var integer
     */
    private $private_key;
    
    /**
     * RSAMathsTools class
     * @var RSATools
     */
    private $mathsTools;
    
    /**
     * RSAStringTools class
     * @var RSATools
     */
    private $stringTools;
    
    /**
     * RSA constructor
     */
    function __construct($modulus = null, $private = null, $public = null) {
        $this->mathsTools = new RSAMathsTools();
        $this->stringTools = new RSAStringTools();
        
        $this->modulus = $modulus;
        $this->private_key = $private;
        $this->public_key = $public;
    }//CONSTRUCTOR
    
    /**
     * set modulus
     * @param integer $modulus modulus
     */
    public function setModulus( $modulus) {
        $this->modulus = $modulus;
    }//SETMODULUS
        
    /**
     * set public key
     * @param integer $public_key public key
     */
    public function setPublicKey( $public_key) {
        $this->public_key = $public_key;
    }//SETPUBLICKEY
    
    /**
     * set private key
     * @param integer $private_key private key
     */
    public function setPrivateKey( $private_key) {
        $this->private_key = $private_key;
    }

    /**
     * encrypt message
     * @param string $message message
     */
    public function encrypt($message) {
        //$message = implode($message);
        //$message .= '§';
        $message = $this->stringTools->str2Int($message);
        //$message = $this->stringTools->createChunk($message);
        
        $crypted = array();
        foreach($message as $chunk) {
            $letter = gmp_intval($this->mathsTools->modExp((int)$chunk, $this->public_key, $this->modulus));
            array_push($crypted, (string)$letter);
        }
        
        //$crypted = $this->stringTools->int2Str($crypted);
        $crypted = implode(' ',$crypted);
        return $crypted;
    }
    
    /**
     * decrypt message
     * @param string $message encrypted message
     */
    public function decrypt($message) {
        $message = explode(' ', $message);
        $crypted = array();
        foreach($message as $chunk) {
            $letter = gmp_intval($this->mathsTools->modExp((int)$chunk, $this->private_key, $this->modulus));
            array_push($crypted, $letter);
        }
        
        //$crypted = $this->stringTools->reformChunk($crypted);
        $crypted = $this->stringTools->int2Str($crypted);
        return substr($crypted, 0, -1);
    }
}
