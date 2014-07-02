<?php
/**
* Verification Payment table
*
* @category model
* @author Eftakhairul Islam <eftakhairul@gmail.com> (http://eftakhairul.com)
*/

class Verification_payment extends MY_Model
{
    public function  __construct()
    {
        parent::__construct();
        $this->loadTable('tbl_verification_payment', 'id');
    }

    /**
     * Save data into
     *
     * @param array $data
     * @return bool
     */
    public function save(array $data = array())
    {
        if (empty($data)) return false;

        $data['create_date'] = date("Y -m -d");
        return $this->insert($data);
    }

    /**
     * Take id and array of key pair value for update the table
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data = array())
    {
        if(empty($data) OR empty($id)) return false;
        parent::update($data, $id);
        return true;
    }

    /**
     * Get all by tbl_verification_payment ID
     *
     * @param $id
     * @return array|bool
     */
    public function findById($id)
    {
        if(empty($id)) return false;

        $query  = $this->db->get_where('tbl_verification_payment', array('id' => $id));
        $result = $query->row();

        return empty($result)? false : $result;
    }

    /**
     * Get details of payment and associated user information by payment id
     *
     * @param $paymentId
     * @return mixed
     */
    public function getPaymentWithPropertyAndUserDetails($paymentId)
    {

        $this->db->select("tbl_verification_payment.*,
                           tbl_property.title as prop_name,
                           tbl_users.first_name as ufname,
                           tbl_users.last_name as ulname,
                           tbl_users.email");

        $this->db->from("tbl_property");
        $this->db->join('tbl_verification_payment', 'tbl_verification_payment.property_id = tbl_property.id');
        $this->db->join('tbl_users', 'tbl_verification_payment.user_id = tbl_users.id');
        $this->db->where("tbl_verification_payment.id = ${paymentId}");

        return $this->db->get()->row();
    }

    /**
     * Process http request by PHP CURL
     *
     * @param $url
     * @param $body
     * @return mixed
     */
    public function post_to_url($url, $body)
    {
        $this->load->library('curl');
        $result = $this->curl->simple_get($url, $body);

        return $result;
    }
}
