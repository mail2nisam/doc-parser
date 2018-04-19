<?php 
use  PHPUnit\Framework\TestCase;
/**
*  Corresponding Class to test Word class
*
*  For each class in your library, there should be a corresponding Unit-Test for it
*  Unit-Tests should be as much as possible independent from other test going on.
*
*  @author nisam
*/
class WordClassTest extends TestCase {
	
  /**
  * Just check if the Word has no syntax error
  *
  * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
  * any typo before you even use this library in a real project.
  *
  */
  public function testIsThereAnySyntaxError(){
	$var = new \Document\Parser\Word;
	$this->assertTrue(is_object($var));
	unset($var);
  }

  
}