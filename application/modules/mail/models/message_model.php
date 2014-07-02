<?php


/**
* Message Model based tbl_pm
*
* @category model
* @author Eftakhairul Islam <eftakhairul@gmail.com> (http://eftakhairul.com)
*/
include_once(BASEPATH . "helpers/dompdf/dompdf_config.inc.php");
class Message_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->loadTable('tbl_pm', 'id');
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

        $data['timestamp'] = time();
        $data['message']   = strip_tags($data['message']);

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

        if(!empty($data['message'])) {
            $data['message']   = strip_tags($data['message']);
        }

        parent::update($data, $id);
        return true;
    }

    /**
     * Get all by tbl_verification_payment ID
     *
     * @param $id
     * @param string $user
     * @return array|bool
     */
    public function findById($id, $user = 'from_user')
    {
        if(empty($id)) return false;

        $this->db->select("tbl_pm.*, tbl_users.first_name, tbl_users.last_name");
        $this->db->join('tbl_users', " tbl_users.id = tbl_pm.${user}", "left");
        $this->db->where("tbl_pm.id = {$id}");

        $query = $this->db->get($this->table);

        $result = $query->row();

        return empty($result)? false : $result;
    }

    /**
     *  Get all with user information
     *
     * @param null $conditions
     * @param string $user
     * @return mixed
     */
    public function getAll($conditions = null, $user = 'from_user')
    {
        if ($conditions != null)  {
			if(is_array($conditions)) {
				$this->db->where($conditions);
			} else {
				$this->db->where($conditions, null, false);
			}
		}

        $this->db->select("tbl_pm.*, tbl_users.first_name, tbl_users.last_name");
        $this->db->join('tbl_users', " tbl_users.id = tbl_pm.${user}", "left");
		$query = $this->db->get($this->table);

		return $query->result();
    }

    /**
     * Delete bulk message based array of ID
     *
     * @param array $ids
     * @return bool
     */
    public function bulkDelete($ids = array())
    {
        if(empty($ids)) return false;

        foreach($ids as $index => $id)
        {
            $this->remove($id);
        }

        return true;
    }
}
