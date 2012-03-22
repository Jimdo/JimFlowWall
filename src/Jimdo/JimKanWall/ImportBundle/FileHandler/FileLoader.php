<?php

namespace Jimdo\JimKanWall\ImportBundle\FileHandler;

use \Jimdo\JimKanWall\ImportBundle\Exception\NoMatchingFileException;


class FileLoader
{

    public function __construct() {
    }

    public function getContentAsJsonObject($splFileInfo)
    {
        $spfFileObject = $splFileInfo->openFile();

        $content = '';

        while (!$spfFileObject->eof()) {
            $content .= $spfFileObject->fgets();
        }

        return json_decode($content);
    }
}
