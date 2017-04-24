<?php
namespace generators;

class writer
{
    /**
     * @param string $dir
     * @return bool
     */
    private function mkdir_target(string $dir): bool
    {
        if(!is_dir($dir))
        {
            mkdir($dir, 0777, true);
        }

        return true;
    }

    /**
     * @param array $replacement
     * @param string $source
     * @param string $target
     * @return bool
     */
    function write_html(array $replacement, string $source, string $target): bool
    {
        #print_r(func_get_args()); #die();
        $this->mkdir_target(dirname($target));

        $file_contents = file_get_contents($source);

        #die($file_contents);
        print_r($replacement["__ADD_FIELDS__"]); #die("dd");

        $file_contents = str_replace("#__CLASS_NAME__",      $replacement["__CLASS_NAME__"], $file_contents);
        $file_contents = str_replace("#__DETAILS_FIELDS__", implode("\r\n", $replacement["__DETAILS_FIELDS__"]), $file_contents);
        $file_contents = str_replace("#__ADD_FIELDS__",     implode("\r\n", $replacement["__ADD_FIELDS__"]),   $file_contents);
        $file_contents = str_replace("#__LISTED_ROWS__",    implode("\r\n", $replacement["__LISTED_ROWS__"]),  $file_contents);
        $file_contents = str_replace("#__FLAG_FIELDS__",    implode("\r\n", $replacement["__FLAG_FIELDS__"]),  $file_contents);
        $file_contents = str_replace("#__EDIT_FIELDS__",    implode("\r\n", $replacement["__EDIT_FIELDS__"]),  $file_contents);
        $file_contents = str_replace("#__COLUMN_NAMES__",   implode("\r\n", $replacement["__COLUMN_NAMES__"]), $file_contents);
        $file_contents = str_replace("#_COLUMN_HEADS__",    implode("\r\n", $replacement["__COLUMN_HEADS__"]), $file_contents);

        # Others
        #$file_contents = str_replace("// #__PUBLIC_METHODS__",    "", $file_contents);

        file_put_contents($target, $file_contents);
        return true;
    }

    /**
     * @param $body
     * @param $dir_path
     * @return bool
     */
    function write_scripts($dir_path, $body): bool
    {
        $dir = dirname($dir_path);
        $file = basename($dir_path);
        $this->mkdir_target($dir);

        $total = file_put_contents("{$dir}/{$file}", $body);
        #echo $body;
        echo "\r\n", $dir_path;
        return $total > 0;
    }
}
