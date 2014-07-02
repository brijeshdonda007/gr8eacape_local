<?php

/**
* Mail Service Controller
*
* @category Controller
* @author Eftakhairul Islam <eftakhairul@gmail.com> (http://eftakhairul.com)
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mail
 */
class Mail extends CI_Controller
{

    const READED    = 1;
    const UNREADED  = 0;

    private $data;

    /**
     * Initialization
     */
    function __construct()
    {
		parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
		$this->load->library('session');
        $this->load->model('mail/message_model');
		$this->load->database();
        $this->load->model('login/Site_setting_model');
        $this->load->model('user/user_model');

        $this->data['user_profile_info']    = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $this->data['unread_notifications'] = $this->user_model->getUnreadNotifications($this->data['user_profile_info']->id);
		$this->data['settings']             = $this->Site_setting_model->get_site_info(1);
		$this->data['header_menus']         = $this->Site_setting_model->get_header_menu();
		$this->data['footer_menus']         = $this->Site_setting_model->get_footer_menu();
		$this->data['footer_bottom_menus']  = $this->Site_setting_model->get_footer_bottom_menu();
	}

    /**
     *  Represent the inbox
     *
     * @route /mail/message/inbox
     */
    public function inbox()
    {
		if($this->session->userdata('Fb_user')) {
			$this->data['fb_arr'] = $this->session->userdata('Fb_user');
		}

        $messageModel                       = new Message_model();
		$userId                             = $this->session->userdata('user_id');
		$this->data['messages']             = $messageModel->getAll(array('to_user' => $userId));
		$this->data['main_client_view']     = 'user/user-dashboard';
		$this->data['dashboard_content']    = 'mail/inbox';
		$this->data['page_title']           = 'Inbox';

		$this->load->view('user', $this->data);
	}

    /**
     *  Represent the inbox
     *
     * @route /mail/message/outbox
     */
    public function outbox()
    {
		if($this->session->userdata('Fb_user')) {
			$this->data['fb_arr'] = $this->session->userdata('Fb_user');
		}

        $messageModel                       = new Message_model();
		$userId                             = $this->session->userdata('user_id');
		$this->data['messages']             = $messageModel->getAll(array('from_user' => $userId), 'to_user');
		$this->data['main_client_view']     = 'user/user-dashboard';
		$this->data['dashboard_content']    = 'mail/outbox';
		$this->data['page_title']           = 'Outbox';

		$this->load->view('user', $this->data);
	}

    /**
     * Show the new message form
     *
     * @route /mail/message/new
     */
    public function newMessage()
    {
        $this->load->model("escapedetails/escapedetails_model");
        $escapeDetailModel               = new Escapedetails_model();
        $escapeID                        = $this->input->get("id");
        $this->data['escape']            = $escapeDetailModel->findById($escapeID);
        $this->data['main_client_view']  = 'user/user-dashboard';
		$this->data['dashboard_content'] = 'mail/newMessage';
		$this->data['page_title']        = 'New Message';

		$this->load->view('user', $this->data);
	}

    /**
     * Save the message
     *
     * @route /mail/message/save
     */
    public function saveMessage()
    {
        $this->load->model("escapedetails/escapedetails_model");

        $messageModel        = new Message_model();
        $escapeDetailModel   = new Escapedetails_model();
        $escape              = $escapeDetailModel->findById($this->input->post("escape_id"));
        $messageModel->save(array('message'          => $this->input->post("message"),
                                  'to_user'          => $this->input->post("owner"),
                                  'booking_id'       => $this->input->post("escape_id"),
                                  'from_user'        => $this->input->post("escape_person"),
                                  'subject'          => $this->input->post("subject")
                            )
        );


        $this->session->set_flashdata('success_msg', 'Message is sent.');

        if ($this->input->post("escape_id")) {
           redirect("escapedetails/" . $escape['custom_url']);
        } else {
           redirect('home');
        }
    }

    /**
     * Read the message
     *
     * @route /mail/message/read
     */
    public function readMessage()
    {
        $messageId                        = $this->input->get('mgs_id');
        $this->data['type']               = $this->input->get('type');

        if($this->session->userdata('Fb_user')) {
			$this->data['fb_arr'] = $this->session->userdata('Fb_user');
		}

        $messageModel = new Message_model();
        $messageModel->update($messageId, array('is_read' =>self::READED));

		$this->data['main_message']       = $messageModel->findById($messageId,
                                                                    $this->data['type']);

		$this->data['page_title']         = 'Message Detail';
		$this->data['main_client_view']   = 'user/user-dashboard';
		$this->data['dashboard_content']  = 'mail/read_message';

		$this->load->view('user', $this->data);
    }


    /**
     * Delete an message by id
     *
     * @route /mail/message/delete
     */
    public function deleteMessage()
    {
        $messageModel = new Message_model();
        $messageId    = $this->input->get('mgs_id');
        $type         = $this->input->get('type');

        $messageModel->remove($messageId);
        $this->session->set_flashdata('success_msg', 'Message is delete successfully.');
        redirect('/mail/message/'.$type);
    }


    /**
     * Delete all bulk messages by ids
     *
     * @route /mail/message/bulkDelete
     */
    public function deleteBulkMessage()
    {
        $messageModel = new Message_model();
        $messageIds   =  $this->input->post('mgs_ids');

        if($messageModel->bulkDelete($messageIds)){
            echo json_encode(array('status' => true));
        } else {
            echo json_encode(array('status' => false));
        }
    }
}
