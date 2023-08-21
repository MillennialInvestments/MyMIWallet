<?php
$environment		= 1;
$cuUserID	 		= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$cuRole		 		= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';

if ($cuUserID !== 2) {
    $pageURI			= $this->uri->uri_string();
    // Get/Set Page View Page ID
    $this->db->from('bf_marketing_page_views');
    $this->db->where('page', $pageURI);
    $getPageViews	= $this->db->get();
    if (!empty($getPageViews)) {
        foreach ($getPageViews->result_array() as $pageInfo) {
            $pageID			= $pageInfo['id'];
            $pageViews		= $pageInfo['views'];
        }
    } else {
        if ($pageID === null) {
            $category 		= $this->uri->segment(1);
            if ($category === null) {
                $category	= 'Home';
                $pageURI	= '/';
            } else {
                $category	= $category;
                $pageURI	= $pageURI;
            }
            // Total Page Views
            $data = array(
            'type'		=> 'Public',
            'category'	=> $category,
            'page'		=> $pageURI,
            'views'		=> 1,
        );
        
            $this->db->insert('bf_marketing_page_views', $data);
            // Page Views per User
            $data = array(
            'date'		=> date("n/j/y"),
            'time'		=> date("g:i A"),
            'type'		=> 'Public',
            'category'	=> $category,
            'page'		=> $pageURI,
            'views'		=> 1,
            'user_id'	=> $cuID,
        );
        
            $this->db->insert('bf_marketing_page_views_per_user', $data);
        } else {
            $category 		= $this->uri->segment(1);
            if ($category === null) {
                $category	= 'Home';
            } else {
                $category	= $category;
            }
            $data = array(
            'type'		=> 'Public',
            'category'	=> $category,
            'page'		=> $pageURI,
            'views'		=> $pageViews + 1,
        );
            $this->db->where('id', $pageID);
            $this->db->update('bf_marketing_page_views', $data);
            $data = array(
            'date'		=> date("n/j/y"),
            'time'		=> date("g:i A"),
            'type'		=> 'Public',
            'category'	=> $category,
            'page'		=> $pageURI,
            'views'		=> 1,
            'user_id'	=> $cuID,
        );
        
            $this->db->insert('bf_marketing_page_views_per_user', $data);
        }
    }
}
