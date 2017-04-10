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

        $lookup_dir = __LIBRARIES__."/../templates";
        $filename = $lookup_dir."/".$filename; // @todo clean file name patterns

        $template = "<?php /** invalid file was read: {$filename} */";
        if(is_file($filename))
        {
            $template = file_get_contents($filename);
        }

        return $template;
    }

    // copy to elsewhere
    public function write(string $body, string $target_file)
    {
        $writer = new writer();
        // output/{$this->current_template}
        // $target_file = "output/".str_replace("entity", $this->class, $this->current_template);
        $writer->write_scripts($body, "output/{$target_file}");
    }
}