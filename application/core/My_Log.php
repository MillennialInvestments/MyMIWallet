<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Log extends CI_Log {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function seo_check() {
        $uri_string                                             = $this->uri->uri_string();

        // Check if URI already exists in the database
        $query                                                  = $this->db->get_where('bf_marketing_page_seo', array('url' => $uri_string));
        if ($query->num_rows() == 0) {
            // If not, create a new entry
            $data                                               = array(
                'url'                                           => $uri_string,
                'title'                                         => str_replace(array('_', '/'), array(' ', ' - '), $uri_string), // Update this according to your needs
                'description'                                   => '',
                'image'                                         => '',
            );
            $this->db->insert('bf_marketing_page_seo', $data);

            // Get the inserted ID for later update
            $insert_id                                          = $this->db->insert_id();
            
            // After we have created a new SEO record, we create and assign a new task
            $task_info                                          = array(
                'task'                                          => 'Page SEO Edit',
                'title'                                         => str_replace(array('_', '/'), array(' ', ' - '), $uri_string),
                'seo_id'                                        => $insert_id,
                'url'                                           => $uri_string,
            );
            $this->assign_marketing_task($task_info); // Replace $role_id with the actual role_id of the user you want to assign the task to
            
            // Fetch the page HTML to parse
            $html                                               = file_get_contents(site_url($uri_string));
            $dom                                                = new DOMDocument;
            libxml_use_internal_errors(true);
            $dom->loadHTML($html);
            libxml_clear_errors();
            $xpath                                              = new DOMXPath($dom);

            // Look for #page_seo_description and #page_seo_image
            $description_element                                = $xpath->query("//*[@id='page_seo_description']");
            $image_element                                      = $xpath->query("//*[@id='page_seo_image']");

            if ($description_element->length > 0) {
                $data['description']                            = $description_element->item(0)->nodeValue;
            }
            if ($image_element->length > 0) {
                $data['image']                                  = $image_element->item(0)->getAttribute('src');
            }

            // Update the newly created record with the found data
            $this->db->update('bf_marketing_page_seo', $data, array('id' => $insert_id));
        }
    }

    public function assign_marketing_task($task_info){
        $data = array(
            'status'                                            => 'Pending', // Assuming there's a status field for tasks
            'group'                                             => 'Marketing', // Assuming tasks are assigned based on role_id
            'task'                                              => $task_info['task'],
            'title'                                             => $task_info['title'],
            'description'                                       => 'Complete SEO for ' . $task_info['url'],
            'url'                                               => site_url('/Management/Marketing/Page-SEO/' . $task_info['seo_id']),
        );
    
        $this->db->insert('bf_management_tasks', $data);
    }
}
