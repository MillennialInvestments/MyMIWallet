<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'vendor/autoload.php';

use Gitlab\Client;

class Gitlab {

    private $ci;
    private $client;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library(array('session', 'settings/settings_lib', 'Template'));
        $this->CI->load->model();
        $this->CI->load->library('users/auth');
        $cuID 								= $this->CI->auth->user_id();
        $this->CI->load->library('form_validation');

        $this->client = Client::create('https://gitlab.com')
            ->authenticate('YOUR_GITLAB_TOKEN', Client::AUTH_HTTP_TOKEN);
    }

    // Projects
    public function all_projects() {
        // No input validation needed for this method
        return $this->client->projects()->all();
    }

    public function show_project($id) {
        // Validate $id
        if (empty($id)) {
            throw new Exception('Project ID cannot be empty');
        }

        return $this->client->projects()->show($id);
    }

    public function create_project($data) {
        // Validate $data
        $this->CI->form_validation->set_data($data);
        $this->CI->form_validation->set_rules('name', 'Project Name', 'required');

        if ($this->CI->form_validation->run() == FALSE) {
            throw new Exception(validation_errors());
        }

        return $this->client->projects()->create($data);
    }

    // Repositories
    public function branches($project_id) {
        // Validate $project_id
        if (empty($project_id)) {
            throw new Exception('Project ID cannot be empty');
        }

        return $this->client->repositories()->branches($project_id);
    }

    public function create_branch($project_id, $branch_name, $ref) {
        // Validate $project_id, $branch_name, and $ref
        if (empty($project_id) || empty($branch_name) || empty($ref)) {
            throw new Exception('Project ID, branch name, and ref cannot be empty');
        }

        return $this->client->repositories()->createBranch($project_id, $branch_name, $ref);
    }

    public function delete_branch($project_id, $branch_name) {
        // Validate $project_id and $branch_name
        if (empty($project_id) || empty($branch_name)) {
            throw new Exception('Project ID and branch name cannot be empty');
        }

        return $this->client->repositories()->deleteBranch($project_id, $branch_name);
    }

    // Issues
    public function all_issues($parameters) {
        // Validate $parameters
        if (!is_array($parameters)) {
            throw new Exception('Parameters must be an array');
        }

        return $this->client->issues()->all($parameters);
    }

    public function show_issue($project_id, $issue_id) {
        // Validate $project_id and $issue_id
        if (empty($project_id) || empty($issue_id)) {
            throw new Exception('Project ID and issue ID cannot be empty');
        }

        return $this->client->issues()->show($project_id, $issue_id);
    }

    public function create_issue($project_id, $data) {
        // Validate $project_id and $data
        if (empty($project_id) || !is_array($data)) {
            throw new Exception('Project ID cannot be empty and data must be an array');
        }

        return $this->client->issues()->create($project_id, $data);
    }

    public function update_issue($project_id, $issue_id, $data) {
        // Validate $project_id, $issue_id, and $data
        if (empty($project_id) || empty($issue_id) || !is_array($data)) {
            throw new Exception('Project ID, issue ID cannot be empty and data must be an array');
        }

        return $this->client->issues()->update($project_id, $issue_id, $data);
    }

    public function remove_issue($project_id, $issue_id) {
        // Validate $project_id and $issue_id
        if (empty($project_id) || empty($issue_id)) {
            throw new Exception('Project ID and issue ID cannot be empty');
        }

        return $this->client->issues()->remove($project_id, $issue_id);
    }

    // Merge Requests
    public function all_merge_requests($project_id) {
        // Validate $project_id
        if (empty($project_id)) {
            throw new Exception('Project ID cannot be empty');
        }

        return $this->client->mergeRequests()->all($project_id);
    }

    public function show_merge_request($project_id, $mr_id) {
        // Validate $project_id and $mr_id
        if (empty($project_id) || empty($mr_id)) {
            throw new Exception('Project ID and merge request ID cannot be empty');
        }

        return $this->client->mergeRequests()->show($project_id, $mr_id);
    }

    public function create_merge_request($project_id, $source_branch, $target_branch, $title, $options) {
        // Validate inputs
        if (empty($project_id) || empty($source_branch) || empty($target_branch) || empty($title) || !is_array($options)) {
            throw new Exception('Inputs cannot be empty and options must be an array');
        }

        return $this->client->mergeRequests()->create($project_id, $source_branch, $target_branch, $title, $options);
    }

    public function update_merge_request($project_id, $mr_id, $data) {
        // Validate $project_id, $mr_id, and $data
        if (empty($project_id) || empty($mr_id) || !is_array($data)) {
            throw new Exception('Project ID, merge request ID cannot be empty and data must be an array');
        }

        return $this->client->mergeRequests()->update($project_id, $mr_id, $data);
    }

    public function remove_merge_request($project_id, $mr_id) {
        // Validate $project_id and $mr_id
        if (empty($project_id) || empty($mr_id)) {
            throw new Exception('Project ID and merge request ID cannot be empty');
        }

        return $this->client->mergeRequests()->remove($project_id, $mr_id);
    }

    // Users
    public function all_users($parameters) {
        // Validate $parameters
        if (!is_array($parameters)) {
            throw new Exception('Parameters must be an array');
        }

        return $this->client->users()->all($parameters);
    }

    public function show_user($user_id) {
        // Validate $user_id
        if (empty($user_id)) {
            throw new Exception('User ID cannot be empty');
        }

        return $this->client->users()->show($user_id);
    }

    public function create_user($data) {
        // Validate $data
        if (!is_array($data)) {
            throw new Exception('Data must be an array');
        }

        return $this->client->users()->create($data);
    }

    public function update_user($user_id, $data) {
        // Validate $user_id and $data
        if (empty($user_id) || !is_array($data)) {
            throw new Exception('User ID cannot be empty and data must be an array');
        }

        return $this->client->users()->update($user_id, $data);
    }

    public function remove_user($user_id) {
        // Validate $user_id
        if (empty($user_id)) {
            throw new Exception('User ID cannot be empty');
        }

        return $this->client->users()->remove($user_id);
    }

    // Groups
    public function all_groups($parameters) {
        // Validate $parameters
        if (!is_array($parameters)) {
            throw new Exception('Parameters must be an array');
        }

        return $this->client->groups()->all($parameters);
    }

    public function show_group($group_id) {
        // Validate $group_id
        if (empty($group_id)) {
            throw new Exception('Group ID cannot be empty');
        }

        return $this->client->groups()->show($group_id);
    }

    public function create_group($data) {
        // Validate $data
        if (!is_array($data)) {
            throw new Exception('Data must be an array');
        }

        return $this->client->groups()->create($data);
    }

    public function update_group($group_id, $data) {
        // Validate $group_id and $data
        if (empty($group_id) || !is_array($data)) {
            throw new Exception('Group ID cannot be empty and data must be an array');
        }

        return $this->client->groups()->update($group_id, $data);
    }

    public function remove_group($group_id) {
        // Validate $group_id
        if (empty($group_id)) {
            throw new Exception('Group ID cannot be empty');
        }

        return $this->client->groups()->remove($group_id);
    }
}