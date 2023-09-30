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
    
    public function testPasswordContainsAtLeast1() {
        
        foreach (range(1, 100) as $index) {
            $pass = Pass::generate(10, [Pass::CLEAN_LOWERCASE, Pass::CLEAN_DIGITS, Pass::CLEAN_SYMBOLS]);
            $this->assertGreaterThanOrEqual(1, preg_match_all("/[_]/", $pass));
            $this->assertGreaterThanOrEqual(1, preg_match_all("/[23456789]/", $pass));
            $this->assertGreaterThanOrEqual(1, preg_match_all("/[abcdefghijkmnopqrstuvwxyz]/", $pass));
            $this->assertSame(0, preg_match_all("/[ABCDEFGHJKLMNPQRSTUVWXYZ]/", $pass));
        }
    }
    
    public function testPasswordContainsAtLeast3() {
        
        foreach (range(1, 100) as $index) {
            $pass = Pass::generate(20, [Pass::ALL_DIGITS, Pass::ALL_LOWERCASE, Pass::ALL_UPPERCASE, '~`#%&_=":;>,<'], 3);
            $this->assertGreaterThanOrEqual(3, preg_match_all("/[". Pass::ALL_DIGITS. "]/", $pass));
            $this->assertGreaterThanOrEqual(3, preg_match_all("/[". Pass::ALL_LOWERCASE. "]/", $pass));
            $this->assertGreaterThanOrEqual(3, preg_match_all("/[". Pass::ALL_UPPERCASE. "]/", $pass));
            $this->assertGreaterThanOrEqual(3, preg_match_all("/[". '~`#%&_=":;>,<'. "]/", $pass));
        }
    }
    
    public function testREADME_mdExamples() {
        // Generate a 14-symbol password that contains at least 1 symbol of each class
        $new_password_1 = Pass::generate(14, [
            Pass::ALL_LOWERCASE,
            Pass::ALL_UPPERCASE,
            Pass::ALL_DIGITS,
            Pass::ALL_SYMBOLS
        ]); // ex. P3H{nh"/|S2.?|

        // Generate a 10-symbol password that contains at least 3 digits and 3 lowercase letters
        $new_password_2 = Pass::generate(10, [
            Pass::CLEAN_DIGITS, 
            Pass::CLEAN_LOWERCASE
        ], 3); // ex. 6kf5czqi86

        // Generate a 4-digits password that contain at least 2 `5`
        $new_password_3 = Pass::generate(4, [
            '012346789', '5'
        ], 2); // ex. 5751

        $this->assertEmpty(null);
    }
    
    public function testIncorrectParams() {

        $this->expectExceptionCode(-10003);
        // Have to be at least 3 + 3 symbols of each class but maximum is 5
        $pass = Pass::generate(5, ['123', 'abc'], 3); 
        echo "$pass\n";
    }
    
}
