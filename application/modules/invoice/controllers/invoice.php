<?php
/**
 * Invoice Controller
 *
 * @category Controller
 * @author Eftakhairul Islam <eftakhairul@gmail.com> (http://eftakhairul.com)
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Invoice extends CI_Controller
{

    /**
     * Initialization value
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model("verification/Verification_payment");
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->plugin('to_pdf');
        $this->load->helper('file');
    }
}
