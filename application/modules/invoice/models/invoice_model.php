<?php
/**
* Invoice model
*
* @category model
* @author Eftakhairul Islam <eftakhairul@gmail.com> (http://eftakhairul.com)
*/

include_once(BASEPATH . "helpers/dompdf/dompdf_config.inc.php");
class Invoice_model extends MY_Model
{

    /**
     * @var CI_Controller
     */
    private $ci;

    public function  __construct()
    {
        parent::__construct();
        ini_set("memory_limit","64M");

        $this->ci =& get_instance();
        $this->ci->load->library('email');
    }


    /**
     * Taking the input HTML, generate PDF based on HTML and return thr path of PDF file
     *
     * @param $html
     * @param $isStream
     * @return string|null
     */
    public function createPdfInvoice($html, $isStream = false)
    {
        $fileName = time() . ".pdf";
        $folder   = APPPATH . "../invoices/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $domPdf = new DOMPDF();
        $domPdf->set_paper("a4", "portrait");
        $domPdf->load_html($html);
        $domPdf->render();

        if ($isStream) {
		    $domPdf->stream($fileName);
	    } else {
            file_put_contents($folder . $fileName , $domPdf->output());
            return $folder . $fileName;
        }
    }

    public function sendVerificationPaymentInvoice($details, $fileAttachedPath)
    {
		$config['protocol'] = 'mail';
		$config['charset']  = 'iso-8859-1';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;

		$this->email->initialize($config);
		$this->email->from('info@gr8escapes.com');
	    $this->email->to($details->email);
		$this->email->subject("Invoice for verification - {$details->prop_name}");


        $message = '<html><style>body,a{font-size:18px;margin:0;font-family:Arial;} a{font-weight:normal;} .italic{font-style:italic;} p{font-size:20px;font-weight:700;color:#1194B2;margin:5px 0;} .normal{font-weight:normal;} h2{color:#EF3873;margin:5px 0;} .content{background-image:url(http://gr8escapes.com/assets/frontend/images/email_template_header.png); background-repeat:no-repeat;width:900px;margin:0 auto;padding-top:200px;} .footer{background-image:url(http://gr8escapes.com/assets/frontend/images/email_template_footer.png); background-repeat:no-repeat;width:900px;margin:0 auto;height:105px;} .text{margin:0 70px;}</style><body><div><div class="content"><div class="text">';
        $message .= "<p><h2>Dear {$details->ufname} {$details->ulname},</h2></p>";
		$message .= '<p> Please find attached your invoice for Escape Name Address Verification.  You will receive an email when your verification code has been posted to you. </p><br/>';
		$message .= '<p><h2 class="italic">The team at Gr8 Escapes</h2></p>';
		$message .= '</div></div>';
		$message .= '<div class="footer" style="position:relative;">';
		$message .= '<a href="http://gr8escapes.com" style="position:relative;top:50px;margin-left: 72px;color: white;">www.gr8escapes.com</a>';
		$message .= '<a href="http://facebook.com/Gr8Escapes" style="position:relative;top:50px;margin-left: 110px;color: white;">www.facebook.com/Gr8Escapes</a>';
		$message .= '<a href="https://twitter.com/gr8_escapes" style="position:relative;top:50px;margin-left: 125px;color: white;">Gr8_Escapes</a>';
		$message .= '</div></div>';
		$message .= '</body></html>';

		$this->email->message($message);
		$this->email->attach($fileAttachedPath);
        $this->email->send();
    }
}

