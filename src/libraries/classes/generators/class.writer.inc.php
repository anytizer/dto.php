<?php

namespace generators;

class writer
{
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
        #print_r($replacement["__ADD_FIELDS__"]); #die("dd");

        $file_contents = str_replace("#__CLASS_NAME__", $replacement["__CLASS_NAME__"], $file_contents);
        $file_contents = str_replace("#__DETAILS_FIELDS__", implode("\r\n", $replacement["__DETAILS_FIELDS__"]), $file_contents);
        $file_contents = str_replace("#__ADD_FIELDS__", implode("\r\n", $replacement["__ADD_FIELDS__"]), $file_contents);
        $file_contents = str_replace("#__LISTED_ROWS__", implode("\r\n", $replacement["__LISTED_ROWS__"]), $file_contents);
        $file_contents = str_replace("#__FLAG_FIELDS__", implode("\r\n", $replacement["__FLAG_FIELDS__"]), $file_contents);
        $file_contents = str_replace("#__EDIT_FIELDS__", implode("\r\n", $replacement["__EDIT_FIELDS__"]), $file_contents);
        $file_contents = str_replace("#__COLUMN_NAMES__", implode("\r\n", $replacement["__COLUMN_NAMES__"]), $file_contents);
        $file_contents = str_replace("#_COLUMN_HEADS__", implode("\r\n", $replacement["__COLUMN_HEADS__"]), $file_contents);

        # Others
        #$file_contents = str_replace("// #__PUBLIC_METHODS__",    "", $file_contents);

        file_put_contents($target, $file_contents);
        return true;
    }

    /**
     * @param string $dir
     * @return bool
     */
    private function mkdir_target(string $dir): bool
    {
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        return true;
    }

    /**
     * @param $dirpath
     * @param $body
     * @return bool
     */
    function write_scripts($dirpath, $body): bool
    {
        $dir = dirname($dirpath);
        $file = basename($dirpath);
        $filepath = "{$dir}/{$file}";

        $this->mkdir_target($dir);

        $total = 0;

        /**
         * Save the file if the user modified it
         */
        $DO_NOT_OVERWRITE = false; // only good if the phpunit methods were produced in different files
        if (is_file($filepath)) {
            if (!$DO_NOT_OVERWRITE) {
                $total = file_put_contents($filepath, $body);
                echo "\r\nWriting: ", $filepath;
            } else {
                # Do NOT write
                echo "\r\nDid not overwrite: ", $filepath;
            }
        } else {
            // Copied first block above
            $total = file_put_contents($filepath, $body);
            echo "\r\nWriting: ", $filepath;
        }

        return $total > 0;
    }
}
