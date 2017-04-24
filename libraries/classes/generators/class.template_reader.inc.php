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

        $lookup_dir = realpath(__LIBRARIES_DIR__."/../templates");
        $filename = "{$lookup_dir}/{$filename}"; // @todo clean file name patterns

        $template = "<?php /** invalid file was read: {$filename} */";
        if(is_file($filename))
        {
            $template = file_get_contents($filename);
        }
        else
        {
            echo "\r\nInvalid read: {$filename}";
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
        // output/{$this->current_template}
        // $target_file = "output/".str_replace("entity", $this->class, $this->current_template);
        #$writer->write_scripts($body, "D:/htdocs/o/{$target_file}"); // works
        $writer->write_scripts(__OUTPUT__."/{$target_file}", $body); // works
    }
}