<?php

class Pdf_model extends CI_Model
{
    public function downloadEachTrnsx($id)
    {
        $sql     = "select a.*,b.title as prop_name, c.first_name as ufname, c.last_name as ulname
                    from tbl_property b
                    inner join tbl_booking a on a.property_id = b.id
                    inner join tbl_users c on a.user_id = c.id
                    where a.id = '" . $id . "'";

        $query  = $this->db->query($sql);
        return $query->row();
    }
}
