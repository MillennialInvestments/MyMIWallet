<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Minify_html
{
    public function minify_output()
    {
        // Get the current output buffer
        $output = ob_get_contents();

        // Check if the output buffer is empty
        if (!empty($output)) {
            // Remove comments
            $output = preg_replace('/<!--(?!<!)[^\[>].*?-->/', '', $output);

            // Remove excess whitespace
            $output = preg_replace('/\s{2,}/', ' ', $output);
            $output = preg_replace('/(\r\n|\n|\r)/', '', $output);

            // Send the modified output to the browser
            ob_end_clean();
            echo $output;
        }
    }

    public function enable()
    {
        ob_start_flush();
        $CI =& get_instance();
        $CI->output->enable_profiler(false);
        $CI->output->set_output('');
        $CI->output->_display();
        $CI->output->set_output(ob_get_contents());
        $CI->output->_display();
        ob_end_flush();
    }
}