<?php

    function display_error($validation,$field)
    {
//        if($validation->hasError($field))
//        {
//            return $validation->getError($field);
//        }
//        else
//        {
//            return false;
//        }
//        $validation = session()->has('validation') ? session()->get('validation') : false;
        if($validation !== null){
            $error = '<span class="text-danger">'.($validation->hasError($field) ? $validation->getError($field) : '').'</span>';
            return $error;
        }
        
        return '';
    }
    
    function checkUser(\App\Libraries\UserRole $user_role){
        return session()->has('user') && session()->get('user_role') == $user_role ? true : false;
    }
    
    function encrypt_url($string)
    {
//       die($string.$rand);
//        $no = rand(10,20);
        return urlencode(base64_encode($string));
//        $encrypter = \Config\Services::encrypter(new \Config\Encryption());
//        return ($encrypter->encrypt($string));
    }
    
    function decrypt_url($string)
    {
//        $len = bin2hex(base64_decode($string));
//        $len = substr((base64_decode($string)),-2);
        return base64_decode(urldecode($string));
//        $encrypter = \Config\Services::encrypter();
//        return $encrypter->decrypt(base64_decode($string));
    }
    
    function gregorianDate($string = 'now', $format = 'Y-m-d'){
        $gregorian = new DateTime($string);
        
        return $gregorian->format($format);
    }
    function ethiopianDate($string = 'now', $format = Andegna\Constants::DATE_ETHIOPIAN){
        $ethiopic = new Andegna\DateTime(new DateTime($string));
        
        return $ethiopic->format($format);
    }
    
    function ordinalize(int $number){
        helper('inflector');
        return $number.'<sup>'.ordinal($number).'</sup>';
    }
    function academicYear(string $start, string $end){
        
        $et_start = ethiopianDate($start,'Y');
        $et_end = ethiopianDate($end,'Y');
        $start = gregorianDate($start,'Y');
        $end = gregorianDate($end,'Y');
        
        
        return ($et_start == $et_end && $start != $end) 
                ?  $et_start.' EC / '.$start.'/'.$end.' GC' 
                : $et_start.' EC / '.$start.' GC';
    }
    
    function firstLetter($string){
        $expr = '/(?<=\s|^)\w/iu';
        preg_match_all($expr,$string,$matches);
        return mb_strtoupper(implode('', $matches[0]));
    }

?>