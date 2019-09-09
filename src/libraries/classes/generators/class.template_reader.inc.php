<?php

namespace generators;

class template_reader
{
    private $current_template;

    /**
     * Reads a template content
     *
     * @param string $filename
     * @return string
     */
    public function read(string $filename): string
    {
        $this->current_template = $filename;

        //$lookup_dir = realpath(__LIBRARIES_DIR__."/../templates");
        $templates_lookup_dir = "D:/htdocs/angular/libraries/dto.php/dto.php/templates";
        $filename = "{$templates_lookup_dir}/{$filename}"; // @todo clean file name patterns

        $template = "<?php /** invalid file was read: {$filename} */";
        if (is_file($filename)) {
            $template = file_get_contents($filename);
        } else {
            echo "\r\nInvalid template file to read: {$filename}";
            die();
        }

        return $template;
    }

    /**
     * Copy source code to elsewhere
     * Replace source
     *
     * @param string $body
     * @param string $target_file
     */
    public function write(string $body, string $target_file)
    {
        $writer = new writer();
        $writer->write_scripts(__OUTPUT__ . "/{$target_file}", $body); // works
    }
}