<?php

namespace Jimdo\JimKanWall\ImportBundle\FileLocator;

class FileLocatorDirectory
{
    private $dir;
    private $files = array();

    public function __construct($dir) {
        $this->dir = $dir;
    }

    public function getFiles($filetypes) {
        $dh  = opendir($this->dir);
        while (false !== ($filename = readdir($dh))) {
            foreach ($filetypes as $filetype) {
                $filename_lower = strtolower($filename);
                $filetype_lower = strtolower($filetype);
                if (strrpos($filename_lower, $filetype_lower) === strlen($filename_lower)-strlen($filetype_lower)) {
                    $created_at = filemtime($this->dir . $filename);
                    $this->files[] = new FileLocatorFile($this->dir . $filename, new \DateTime('@' . $created_at));
                }
            }
        }
        return $this->files;
    }

    static function _cmpDateTimeAsc($fileA, $fileB) {
        $dateTimeA = date_format($fileA->getCreatedAt(), 'U');
        $dateTimeB = date_format($fileB->getCreatedAt(), 'U');

        if ($dateTimeA == $dateTimeB) {
            return 0;
        }

        return ($dateTimeA > $dateTimeB) ? 1 : -1;;
    }
}
