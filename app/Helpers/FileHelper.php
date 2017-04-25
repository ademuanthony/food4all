<?php
/**
 * Created by PhpStorm.
 * User: ELACHI
 * Date: 8/25/2016
 * Time: 9:10 AM
 */

namespace Helpers;


class FileHelper
{
    public static function copyFolderContent($src,$dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    self::copyFolderContent($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

}