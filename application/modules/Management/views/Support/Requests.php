<?php
$pageURIA                           = $this->uri->segment(1);
$pageURIB                           = $this->uri->segment(2);
$pageURIC                           = $this->uri->segment(3);
$pageURID                           = $this->uri->segment(4);
$pageURIE                           = $this->uri->segment(5);
if (empty($pageURIE)) {
    $this->db->from('bf_support_requests');
    $this->db->where('topic', $pageURIB); 
    $getSupportRequests                 = $this->db->get()->result_array(); 
    if ($pageURIB === 'Assets') {
        $dashboardTitle                 = 'Assets /';
        $dashboardSubtitle              = 'Support Requests'; 
    }
    $this->load->view('Management/Support/Requests/Listing', $viewData); 
} else {
    $this->db->from('bf_support_requests');
    $this->db->where('topic', $pageURIB); 
    $this->db->where('id', $pageURIE); 
    $getSupportRequests                 = $this->db->get()->result_array(); 
    if ($pageURIB === 'Assets') {
        $dashboardTitle                 = 'Assets /';
        $dashboardSubtitle              = 'Support Requests - Request #' . $pageURIE; 
    }
    $viewData                           = array(
        'pageURIA'                      => $pageURIA,
        'pageURIB'                      => $pageURIB,
        'pageURIC'                      => $pageURIC,
        'pageURID'                      => $pageURID,
        'pageURIE'                      => $pageURIE,
        'dashboardTitle'                => $dashboardTitle,
        'dashboardSubtitle'             => $dashboardSubtitle,
    );
    $this->load->view('Management/Support/Requests/Details', $viewData); 
}    
?>