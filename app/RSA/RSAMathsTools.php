<?php

/**
 * RSATools using GMP
 * @author Loick Mahieux
 */
class RSAMathsTools {
    /**
     * a^b[n]
     * @param integer $a number a
     * @param integer $b number b
     * @param integer $n number n
     */
    public function modExp($a, $b, $n) {
        return gmp_intval(gmp_powm($a, $b, $n));
    }
    
    /**
     * test if a and b are coprime
     * @param integer $a number a
     * @param integer $b number b
     */
    public function isCoprime($a, $b) {
        return gmp_intval(gmp_gcd($a, $b)) == 1;
    }
    
    /**
     * a*b
     * @param integer $a number a
     * @param integer $b number b
     */
    public function mul($a, $b) {
        return gmp_intval(gmp_mul($a, $b));
    }
    
    /**
     * [a]^(-1)[n]
     * @param integer $a number
     * @param integer $n modulus
     */
    public function invert($a, $n) {
        return gmp_intval(gmp_invert($a, $n));
    }

    /**
     * generate prime number
     * @param integer $length
     */
    public function generatePrime($length) {
        $bin = "1";
        
        $i = 0;
        while($i++ < $length - 2)
            $bin .= rand(0, 1);
        
        $bin .= "1";
        $nb = bindec($bin);
        
        return gmp_intval(gmp_nextprime($nb));
    }
    
    public function isPrime($a) {
        return gmp_intval(gmp_prob_prime($a)) == 2;
    }
    
}
