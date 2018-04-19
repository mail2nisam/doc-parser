<?php

namespace Document\Parser;


/**
 *  Class for word document
 *
 *  This class is using parse the word document and perform some actions.
 * @author nisam
 */
class Word
{
    private $zipArchive;
    private $fileName;
    private $documentXML;

    /**
     * Word constructor.
     */
    public function __construct()
    {
        $this->zipArchive = new \ZipArchive;
    }

    /**
     * Open doc using ZipArchive
     */
    private function open()
    {
        try {
            $fileName = $this->fileName;
            if ($this->zipArchive->open($fileName, \ZipArchive::CREATE) !== TRUE) {
                echo "Cannot open $fileName :( ";
                die;
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            die;
        }
    }

    /**
     * Create output file by copying the template file
     * @param $inputFileName
     * @param $outputFileName
     */
    private function copy($inputFileName, $outputFileName)
    {
        if (!copy($inputFileName, $outputFileName)) {
            die("Could not copy '$inputFileName' to '$outputFileName'");
        }
        $this->fileName = $outputFileName;


    }

    /**
     * Close opened ZipArchive
     */
    private function close()
    {
        $this->zipArchive->close();
    }

    /**
     * Get xml document from extracted ZipArchive
     * @return string
     */
    private function getDocumentXML()
    {
        $this->documentXML = $this->zipArchive->getFromName("word/document.xml");
        return $this->documentXML;
    }

    /**
     * Find and replace text in documentXML
     * @param $placeHolder
     * @param $actualText
     */
    private function replaceText($placeHolder, $actualText)
    {
        try {
            $this->documentXML = str_replace($placeHolder, $actualText, $this->documentXML);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            die;
        }
    }

    /**
     * Save output file
     */
    private function save()
    {
        if ($this->zipArchive->addFromString('word/document.xml', $this->documentXML)) {
            echo 'File written!';
        } else {
            echo 'File not written.  Go back and add write permissions to this folder!l';
        }
    }

    /**
     * find searched keyword or placeholders and generate new output file by replacing with actual texts.
     * @param $templateFileName
     * @param $outputFileName
     * @param array $attributes
     */
    public function findAndReplace($templateFileName, $outputFileName, $attributes = [])
    {
        $this->copy($templateFileName, $outputFileName);
        $this->open();
        $this->getDocumentXML();
        foreach ($attributes as $placeHolder => $actualText) {
            $this->replaceText($placeHolder, $actualText);
        }
        $this->save();
        $this->close();

    }

}