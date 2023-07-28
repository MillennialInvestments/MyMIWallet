<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'vendor/autoload.php';

class Project_management_lib {

    private $ci;
    private $git;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('activity_log_model');
        $this->CI->load->model('audit_trail_model');
        $this->CI->load->model('project_model');
        $this->CI->load->library(array('form_validation', 'Management/Gitlab'));

        $this->git = new PHPGit\Git();
        $this->git->setRepository('/path/to/your/repo');
    }

    // Git operations
    public function add($file) {
        // Validate input
        if (empty($file)) {
            throw new Exception('File path cannot be empty');
        }

        $this->git->add($file);
    }

    public function commit($message) {
        // Validate input
        if (empty($message)) {
            throw new Exception('Commit message cannot be empty');
        }

        $this->git->commit($message);
    }

    public function push($remote = 'origin', $branch = 'master') {
        $this->git->push($remote, $branch);
    }

    public function pull($remote = 'origin', $branch = 'master') {
        $this->git->pull($remote, $branch);
    }

    public function log($file) {
        // Validate input
        if (empty($file)) {
            throw new Exception('File path cannot be empty');
        }

        return $this->git->log($file);
    }

    // Activity logging
    public function log_activity($activity) {
        // Validate input
        if (empty($activity)) {
            throw new Exception('Activity cannot be empty');
        }

        $data = array(
            'user_id' => $this->CI->session->userdata('user_id'),
            'activity' => $activity,
            'timestamp' => date('Y-m-d H:i:s')
        );

        $this->CI->activity_log_model->insert_log($data);
    }

    // Audit trails
    public function log_audit_trail($old_data, $new_data) {
        // Validate input
        if (empty($old_data) || empty($new_data)) {
            throw new Exception('Old data and new data cannot be empty');
        }

        $data = array(
            'user_id' => $this->CI->session->userdata('user_id'),
            'old_data' => json_encode($old_data),
            'new_data' => json_encode($new_data),
            'timestamp' => date('Y-m-d H:i:s')
        );

        $this->CI->audit_trail_model->insert_log($data);
    }

    // Project management
    public function create_task($task_data) {
        // Validate input
        $this->CI->form_validation->set_data($task_data);
        $this->CI->form_validation->set_rules('task_name', 'Task Name', 'required');
        $this->CI->form_validation->set_rules('task_description', 'Task Description', 'required');

        if ($this->CI->form_validation->run() == FALSE) {
            throw new Exception(validation_errors());
        }

        $this->CI->project_model->create_task($task_data);
    }

    public function update_task($task_id, $task_data) {
        // Validate input
        if (empty($task_id)) {
            throw new Exception('Task ID cannot be empty');
        }

        $this->CI->project_model->update_task($task_id, $task_data);
    }

    public function delete_task($task_id) {
        // Validate input
        if (empty($task_id)) {
            throw new Exception('Task ID cannot be empty');
        }

        $this->CI->project_model->delete_task($task_id);
    }

    public function get_task($task_id) {
        // Validate input
        if (empty($task_id)) {
            throw new Exception('Task ID cannot be empty');
        }

        return $this->CI->project_model->get_task($task_id);
    }

    public function get_all_tasks() {
        return $this->CI->project_model->get_all_tasks();
    }

    // Analytical reporting
    public function get_activity_report() {
        return $this->CI->activity_log_model->get_report();
    }

    public function get_audit_trail_report() {
        return $this->CI->audit_trail_model->get_report();
    }

    public function get_project_report() {
        return $this->CI->project_model->get_report();
    }

    // Error handling
    public function log_error($message) {
        log_message('error', $message);
    }

    // Security
    public function check_permissions($required_permission) {
        if (!$this->CI->ion_auth->has_permission($required_permission)) {
            throw new Exception('You do not have the necessary permissions to perform this operation');
        }
    }

    // Performance
    public function cache_query($query, $timeout = 60) {
        if (!$result = $this->CI->cache->get($query)) {
            $result = $this->CI->db->query($query)->result();
            $this->CI->cache->save($query, $result, $timeout);
        }

        return $result;
    }

    // Integration with other services
    public function deploy() {
        // Use the GitLab library to push changes to the GitLab repository
        $this->CI->gitlab_lib->push('origin', 'master');
    }

    // Additional reporting features
    public function get_user_activity_report($user_id) {
        // Use the GitLab library to get the user's activity
        return $this->CI->gitlab_lib->user_activities($user_id);
    }

    public function get_task_completion_report() {
        // Use the GitLab library to get the issues (tasks) of a project
        $issues = $this->CI->gitlab_lib->all_issues(['state' => 'closed']);
        // Filter the issues to get only the completed tasks
        $completed_tasks = array_filter($issues, function($issue) {
            return $issue['state'] == 'closed';
        });
        return $completed_tasks;
    }

    public function get_code_changes_report() {
        // Use the GitLab library to get the commits of a project
        return $this->CI->gitlab_lib->commits('your_project_id');
    }

}
