<?php

include_once "Keys.php";

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RSAStringTools
 *
 * @author loick
 */
class RSAStringTools {
    
    private $phi;
    
    public function setPhi( $phi) {
        $this->phi = $phi;
    }
        
    /**
     * convert string to ASCII value
     * @param string $str string
     * @return ACSI code in ASCII value
     */
    public function str2Int($tab) {
        $ASCII = array();
        if(is_string($tab))
            foreach(str_split($tab) as $value)
                array_push($ASCII, ord($value));
        else
            foreach($tab as $value)
                array_push($ASCII, ord($value));

        return $ASCII;
    }
    
    /**
     * convert ASCII value to string
     * @param string $str string
     * @return ASCII value in ASCII code
     */
    public function int2Str($tab) {
        $ASCII = '';
        foreach($tab as $value)
            $ASCII .= chr($value); 
        
        return $ASCII;
    }
    
    /**
     *  create chunck
     *  @param String $tocut the string we want to cut in chunk
     */
    
public function createChunk($message, $sizeToCut = 4)
{
    //Add 0 to have blocs of 3
    $cuted = '';
    foreach ($message as $value) {
        $str = '';
        $cout = ($sizeToCut - 1) - strlen($value);
        if($cout > 0)
        {
            for($i=0;$i<$cout;$i++)
            {
                $str .= '0';
            }
            
        }
        $cuted .= $str . $value;
    }
    
    //Save position of 0 in a array
    $tabzero = array();
    for ($i = 0;$i < strlen($cuted);++$i) 
    {
        if($cuted[$i] == '0')
        {
            array_push($tabzero,$i);
        }
    }
    
    //Cut str at sizeTocut
    $cuted = str_split($cuted,$sizeToCut);

    for ($i=0; $i < count($tabzero) ; $i++) { 
            if ($tabzero[$i] == 0)   
                array_push($cuted,'250'.$tabzero[$i]);;  

            array_push($cuted,$tabzero[$i].'250');
    }
    
    return $cuted;
}

public function  reformChunk($toreform, $size = 4)
{   
    
    $rech = implode($toreform);
    
    //Search the char who separate message with position of 0
    $pos = strpos($rech, '167');
    
    //Add all the message in reform
    $reform = '';
    for ($i = 0 ;$i<$pos;$i++)
    {
      $reform .= $rech[$i];
    }
    
    //Add all the positions of 0 in a string
    $poszero = "";
    for ($i = $pos+3; $i < strlen($rech) ;$i++ ) 
    { 
        $poszero .= $rech[$i];
    }
   
    //Replace all the code who wrap the 0 positions by a space.
    $poszero = str_replace('250',' ', $poszero);

    //Transform this string into array
    $zero = explode(' ', $poszero);
    
    //For each positions verify if 0 is missing and add it if it lost.
   foreach ($zero as $value) {

        if(!empty($reform[$value]) &&  $reform[$value] != 0)
        {
            $reform = substr_replace($reform, '0', $value, 0);
        }
   }
    $reform = str_split($reform,$size-1);

    return $reform;
}


}
