<?php

use  PHPUnit\Framework\TestCase;

/**
 *  Corresponding Class to test Word class
 *
 *  For each class in your library, there should be a corresponding Unit-Test for it
 *  Unit-Tests should be as much as possible independent from other test going on.
 *
 * @author nisam
 */
class WordClassTest extends TestCase
{

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $sampleDocxFileName = "sample.docx";
        $fileContent = file_get_contents("https://docs.google.com/document/d/1JXqYbHxV3TjeKKXu2hbeFqfuLCXzz7YQrwXPbshfcqg/export?format=docx");
        file_put_contents($sampleDocxFileName, $fileContent);

    }

    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass(); 
        $sampleDocxFileName = "sample.docx";
        unlink($sampleDocxFileName);
    }

    /**
     * Just check if the Word has no syntax error
     *
     * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
     * any typo before you even use this library in a real project.
     *
     */
    public function testIsThereAnySyntaxError()
    {
        $var = new \Document\Parser\Word;
        $this->assertTrue(is_object($var));
        unset($var);
    }

    /**
     * CHeck input file is existing
     */
    public function testInputFileIsAvailable()
    {

        $sampleDocxFileName = "sample.docx";
        $this->assertTrue(file_exists($sampleDocxFileName));
    }

    /**
     * test testFindAndReplace  method
     */
    public function testFindAndReplace()
    {
        $sampleDocxFileName = "sample.docx";
        $outputFile = "modified.docx";
        $wordObj = new \Document\Parser\Word;
        $wordObj->findAndReplace($sampleDocxFileName, $outputFile, ["Lorem" => "{{Lorem}}", "ipsum" => "{{ipsum}}"]);
        $this->assertTrue(file_exists($outputFile));
        unlink($outputFile);
    }

}