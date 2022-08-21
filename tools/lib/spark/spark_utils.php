<?php

// backward compatibility
if (!function_exists('sys_get_temp_dir')) {
    function sys_get_temp_dir()
    {
        if ($temp = getenv('TMP')) {
            return $temp;
        }
        if ($temp = getenv('TEMP')) {
            return $temp;
        }
        if ($temp = getenv('TMPDIR')) {
            return $temp;
        }
        $temp = tempnam(__FILE__, '');
        if (file_exists($temp)) {
            unlink($temp);
            return dirname($temp);
        }
        return '/tmp'; // the best we can do
    }
}

class Spark_utils
{
    private static $buffer = false;
    private static $lines = array();

    public static function get_lines()
    {
        return self::$lines;
    }

    public static function buffer()
    {
        self::$buffer = true;
    }

    public static function full_move($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    self::full_move($src . '/' . $file, $dst . '/' . $file);
                } else {
                    rename($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    public static function remove_full_directory($dir, $vocally = false)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != '.' && $object != '..') {
                    if (filetype($dir . '/' . $object) == "dir") {
                        self::remove_full_directory($dir . '/' . $object, $vocally);
                    } else {
                        if ($vocally) {
                            self::notice("Removing $dir/$object");
                        }
                        unlink($dir . '/' . $object);
                    }
                }
            }
            reset($objects);
            return rmdir($dir);
        }
    }

    public static function notice($msg)
    {
        self::line($msg, 'SPARK', '[1;36m');
    }

    public static function error($msg)
    {
        self::line($msg, 'ERROR', '[1;31m');
    }

    public static function warning($msg)
    {
        self::line($msg, 'WARNING', '[1;33m');
    }

    public static function line($msg = '', $s = null, $color = null)
    {
        foreach (explode("\n", $msg) as $line) {
            if (self::$buffer) {
                self::$lines[] = $line;
            } else {
                echo !$s ? "$line\n" : chr(27) . $color . "[ $s ]" . chr(27) . "[0m" . " $line\n";
            }
        }
    }
}
