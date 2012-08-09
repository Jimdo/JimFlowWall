<?php

namespace Jimdo\JimKanWall\ImportBundle\FileHandler;

use \Jimdo\JimKanWall\ImportBundle\Exception\NoMatchingFileException;


class FileLoader
{

    public function __construct() {
    }

    public function getContentAsJsonObject($splFileInfo)
    {
        $splFileObject = $splFileInfo->openFile();

        $content = '';

        while (!$splFileObject->eof()) {
            $content .= $splFileObject->fgets();
        }

        //unlink($splFileObject);

        return json_decode($content);
    }
}
