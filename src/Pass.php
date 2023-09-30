<?php

namespace losthost\passg;

class Pass {
    
    static public function generate($password_length=14, $password_symbols='_123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ') {
        $symbols_max_index = strlen($password_symbols) - 1; 
        $result = '';
        
        for ($index = 0; $index < $password_length; $index++) {
            $result .= substr($password_symbols, random_int(0, $symbols_max_index), 1);
        }

        return $result;
    }
}
