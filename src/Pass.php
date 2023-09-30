<?php

namespace losthost\passg;

class Pass {
    
    const ALL_UPPERCASE = 'ABCDEFGHIGKLMNOPQRSTUVWXYZ';
    const ALL_LOWERCASE = 'abcdefghijklmnopqrstuvwxyz';
    const ALL_DIGITS    = '0123456789';
    const ALL_SYMBOLS   = '~`!@#$%^&*()_-+={}[]|\\":\';/.?>,<';
    const ALL           = self::ALL_UPPERCASE. self::ALL_LOWERCASE. self::ALL_DIGITS. self::ALL_SYMBOLS;
    
    const CLEAN_UPPERCASE   = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
    const CLEAN_LOWERCASE   = 'abcdefghijkmnopqrstuvwxyz';
    const CLEAN_DIGITS      = '23456789';
    const CLEAN_SYMBOLS     = '_';
    const CLEAN             = self::CLEAN_UPPERCASE. self::CLEAN_LOWERCASE. self::CLEAN_DIGITS. self::CLEAN_SYMBOLS;

    static public function generate($password_length=14, string|array $password_symbols=self::CLEAN, $at_least=1) {
        
        $result = '';
        $generated = 0;
        
        if (is_array($password_symbols)) {
            foreach ($password_symbols as $symbols) {
                $result .= self::generate($at_least, $symbols);
                $generated += $at_least;
            }
            if ($generated > $password_length) {
                throw new \Exception("The password length can't hold all symbols.", -10003);
            }
            $the_symbols = implode('', array_merge($password_symbols));
        } else {
            $the_symbols = $password_symbols;
        }
        
        $symbols_max_index = strlen($the_symbols) - 1; 
        
        for ($index = 0; $index < $password_length-$generated; $index++) {
            $result .= substr($the_symbols, random_int(0, $symbols_max_index), 1);
        }

        return str_shuffle($result);
    }
}
