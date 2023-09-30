<?php

namespace losthost\passg;
use PHPUnit\Framework\TestCase;

class PassTest extends TestCase {
    
    public function testCanGenerateDefaultPassword() {
        $pass = Pass::generate();
        $this->assertSame(14, strlen($pass));
    }
    
    public function testPasswordsAreDifferent() {
        $pass1 = Pass::generate();
        $pass2 = Pass::generate();
        $this->assertNotEquals($pass2, $pass1);
    }
    
    public function testPasswordLengthIsExpected() {
        $pass5 = Pass::generate(5);
        $pass8 = Pass::generate(8);
        $pass100 = Pass::generate(100);
        
        $this->assertSame(5, strlen($pass5));
        $this->assertSame(8, strlen($pass8));
        $this->assertSame(100, strlen($pass100));
    }
    
    public function testPasswordIsOf() {
        $passU = Pass::generate(10, 'U');
        $passABc = Pass::generate(20, 'ABc');
        
        $this->assertEquals('UUUUUUUUUU', $passU);
        $this->assertMatchesRegularExpression("/^[ABc]{20}$/", $passABc);
    }
}
