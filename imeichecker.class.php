<?php
/**
 * Author: Tomas Pavlatka (tomas.pavlatka@gmail.com)
 * Created: Jan 23, 2011
 */

class PTX_ImeiChecker {
    
    /**
     * Is valid.
     * 
     * checks whether {$imei} is valid or  not
     * @param $imei - imei to be tested
     * @return true | false - (false)
     */
    public static function isValid($imei) {
        if(!is_numeric($imei)) {
            return false;
        } else {
            if(!preg_match('/^[0-9]*$/',$imei)) {
                return false;
            } else {
                if(strlen($imei) != 15) {
                    return false;
                } else {             
                    return self::_isValid($imei);
                }
            }
        }
    }
    
    /**
     * Count sum (private).
     * 
     * counts sum from digits
     * @param $digits - array with digits.
     * @return final sum
     */
    private static function _countSum(array $digits) {
        $sum = 0;
        $counter = 1;
        foreach($digits as $digit) {
            if($counter++ %2 == 0) {
                $localSum = (int)($digit*2);
                
                if($localSum > 9) {
                    $localSum = 1+($localSum-10);
                }
                
                $sum += (int)$localSum;
                
            } else {
                $sum += (int)$digit;
            } 
            
            if($counter == 15) {
                break;
            }
        }
        
        return (int)$sum;
    }
        
    /**
     * Is valid (private).
     * 
     * checks whether {$imei} is valid or not
     * @param $imei - imei to be tested
     * @return true | false (false)
     */
    private static function _isValid($imei) {
        $digitsArray = array();
        for($i=0; $i < 15; $i++) {
            $digitsArray[] = substr($imei,$i,1);
        }
        
        $sum = self::_countSum($digitsArray);
        $modulo = $sum % 10;
        if($modulo == 0) { 
            $checkDigit = 0;
        } else {
            $checkDigit = 10 - $modulo;
        }
        
        return ($checkDigit == $digitsArray[14]) ? true : false;
    }
}