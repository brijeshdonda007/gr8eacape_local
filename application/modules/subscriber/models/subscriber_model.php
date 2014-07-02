<?php

class Subscriber_model extends CI_Model{

    function getUserInfo($user_id)

    {

        $query = $this->db->get_where('tbl_users', array('id' => $user_id));

        return $query->row();

    }

    function get_all_subscriber()

    {

        $this->db->select('*');

        $this->db->from('tbl_email_subscriber');

        $this->db->order_by('id', 'desc');

        $query = $this->db->get();

        return $query->result();

    }

    

    function export_csv()

    {

            $this->db->select('*');

            $this->db->from('tbl_email_subscriber');

            $this->db->order_by('id', 'desc');

            $query = $this->db->get(); 

            

            if(!$query)

                return false;



            $this->load->helper('Excel_helper');



            $objPHPExcel = new PHPExcel();

            $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");



            $objPHPExcel->setActiveSheetIndex(0);

            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);

            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); 
            
            $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->setCellValue('A1','FULL NAME');
            
            $objPHPExcel->getActiveSheet()->setCellValue('B1','EMAIL');

            $query_rs = $query->result();

            $newarrayx1 = array();

            $i = 0;

            

            foreach($query_rs as $qrs)

            {

                 $arr_me = $this->arrayOprn($qrs);

                         

                 

                 $arryx = (object) $arr_me;

                 array_push($newarrayx1, $arryx);

                 

            $i++;}

            $fields = array('0' => 'Fullname', '1' => 'Email');

            $row = 2;

            

            foreach($newarrayx1 as $data)

            {

                $col = 0;

                foreach ($fields as $field)

                {

                    

                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);

                    $col++;

                }



                $row++;

            }



            $objPHPExcel->setActiveSheetIndex(0);



            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');



            header('Content-Type: application/vnd.ms-excel');

            header('Content-Disposition: attachment;filename="Subscriber_'.date('dMy').'.xls"');

            header('Cache-Control: max-age=0');



            $objWriter->save('php://output');

        

    }

    function arrayOprn($arr)

        {

            $newarrayx->Fullname = $arr->full_name;
            $newarrayx->Email = $arr->email_subscriber;
            return $newarrayx;

        }

    

}
