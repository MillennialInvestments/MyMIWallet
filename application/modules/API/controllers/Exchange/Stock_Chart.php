<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Stock_Chart extends REST_Controller
{
    
      /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('exchange_model');
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_get($id = 0)
    {
        $market_pair		= $this->uri->segment(4);
        $market				= $this->uri->segment(5);
        $status 			= 'Closed';
        if (!empty($id)) {
            $data = $this->db->get_where("bf_exchanges_orders", ['market_pair' => $market_pair, 'market' => $market, 'status' => $status,])->row_array();
        } else {
            $select			= 'initial_coin_value';
            $data			= $this->exchange_model->get_market_closed_orders($select, $status, $market_pair, $market);
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    }
      
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_post()
    {
        $input = $this->input->post();
        $this->db->insert('bf_users', $input);
     
        $this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
    }
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('bf_users', $input, array('id'=>$id));
     
        $this->response(['Item updated successfully.'], REST_Controller::HTTP_OK);
    }
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_delete($id)
    {
        $this->db->delete('bf_users', array('id'=>$id));
       
        $this->response(['Item deleted successfully.'], REST_Controller::HTTP_OK);
    }
}
