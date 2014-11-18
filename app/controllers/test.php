<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test
 *
 * @author loick
 */
class testController extends Controller {
    public function index() {
        /**
         * RSAMathsTools
         */
        $maths = new RSAMathsTools();
        echo '--- RSAMathsTools ---';
        var_dump(ord('¬'));
        echo '<br>';
        
        echo 'isCoprime';
        var_dump($maths->isCoprime(6, 35));
        
        echo 'modExp';
        var_dump($maths->modExp(4, 13, 497) == 445);
        
        echo 'invert';
        var_dump($maths->invert(3, 11) == 4);
        
        echo 'mul';
        var_dump($maths->mul(2, 2) == 4);
        
        echo 'generatePrime';
        var_dump($maths->isPrime($maths->generatePrime(10)));
        
        /**
         * RSAStringTools
         */
        $string = new RSAStringTools();
        echo '--- RSAStringTools ---';
        echo '<br>';
        
        echo 'str2Int';
        $test = $string->str2Int(str_split('TEST'));
        var_dump($test == array(
            84,
            69,
            83,
            84
        ));
        
        echo 'int2Str';
        $test = $string->int2Str($test);
        var_dump(str_split($test) == array(
            'T',
            'E',
            'S',
            'T'
        ));
        
        echo 'createChunk';
        $chunk = $string->str2Int('TEST');
        var_dump($chunked = $string->createChunk($chunk));
        
        echo 'reformChunk';
        var_dump($string->reformChunk($chunked));
        
        echo '--- Keys ---';
        echo '<br>';
        
        echo 'KeyA';
        echo '<br>';
        $keyA = new Keys();
        $keyA->generate();
        var_dump($keyA->get());
        
        echo 'KeyB';
        echo '<br>';
        $keyB = new Keys();
        $keyB->generate();
        var_dump($keyB->get());
        
        echo '--- RSA ---';
        echo '<br>';

        $rsa = new RSA($keyA->get()['modulus'], $keyA->get()['private'], $keyA->get()['public']);
        
        echo 'encode';
        var_dump('TEST');
        $encrypt = $rsa->encrypt('trop facile blmqshqsuh');
        var_dump($encrypt);
        
        echo 'decode';
        var_dump($rsa->decrypt($encrypt));
    }
}
