<?php 

class Image extends CI_Controller{

	function __construct(){

		parent::__construct();

		$this->load->model('image_model');

	}

	

	function index(){

		$data['main_content_view']		= 		'image/image_list';

		$this->load->view('default', $data);

	}

	

	function loadform(){

		$data['main_content_view']		=		"image/form";

		$this->load->view('default', $data);

	}

	

	function addUpdateImage(){

            

                $config['overwrite'] = 'TRUE'; 

		$config['upload_path'] = './images/gallery/';

                $config['allowed_types'] = 'gif|jpg|png';

                $config['max_size'] = '200000';

                $config['max_width'] = '3000';

                $config['max_height'] = '40000';



                $this->load->library('upload', $config);

                $this->load->library('image_lib');

                if ( ! $this->upload->do_upload('image'))

                {

                    echo 'error';

//                $data = array('error' => $this->upload->display_errors());

//                $data['product_brand']= $this->admin_ads_model->mng_brand();

//                $this->load->view('admin_view/add_product_pack', $error);

                }

                else

                {

//                    print_r($_FILES);exit();

                $data1 = array('upload_data' => $this->upload->data());

                $image= $data1['upload_data']['file_name'];



                $configBig = array();

                $configBig['image_library'] = 'gd2';

                $configBig['source_image'] = './images/gallery/'.$image;

                $configBig['create_thumb'] = TRUE;

                $configBig['maintain_ratio'] = TRUE;

                $configBig['width'] = 200;

                $configBig['height'] = 200;

                $configBig['thumb_marker'] = "_big";

                $configBig['new_image'] = './images/gallery/bigs';

                $this->image_lib->initialize($configBig);

                $this->image_lib->resize();

                $this->image_lib->clear();

                unset($configBig);



                $configBig = array();

                $configBig['image_library'] = 'gd2';

                $configBig['source_image'] = './images/gallery/'.$image;

                $configBig['create_thumb'] = TRUE;

                $configBig['maintain_ratio'] = TRUE;

                $configBig['width'] = 100;

                $configBig['height'] = 100;

                $configBig['thumb_marker'] = "_thumb";

                $configBig['new_image'] = './images/gallery/thumbs/';

                $this->image_lib->initialize($configBig);

                $this->image_lib->resize();

                $this->image_lib->clear();

                unset($configBig);



                $filename1 = $data1['upload_data']['raw_name'].'_big'.$data1['upload_data']['file_ext'];

                $filename2 = $data1['upload_data']['raw_name'].'_thumb'.$data1['upload_data']['file_ext'];

                $rename = 'profile_img'.'1'.$data1['upload_data']['file_ext'];

                rename('./images/gallery/bigs/' .$filename1, './images/gallery/bigs/' .$rename);

                rename('./images/gallery/thumbs/' .$filename2, './images/gallery/thumbs/' .$rename);

                unlink('./images/gallery/'.$image);



}

	}

	

	function image_upload(){

		$path 							=		 UPLOAD_PATH_PAGE;	

		$name 							= 		$_FILES['featured_image']['name'];

		$size 							= 		$_FILES['featured_image']['size'];

		$valid_formats 					= 		array("jpg", "png", "gif", "jpeg");					

		$data 							=		'';

		if(strlen($name))

				{					

					$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION)); 

					if(in_array($ext,$valid_formats))

					{ 

					if($size<(1024*1024*3))

						{ 

							$old_image 				= 		$path . 'put the old image name';							

							$actual_image_name 		= 		time().$name;  

							$tmp 					= 		$_FILES['featured_image']['tmp_name'];

							move_uploaded_file($tmp, $path.$actual_image_name);

							$data 					= 		$actual_image_name;

						}

					else{

						echo "Image file size max 3 MB";

						}

					}

						else

						echo "Invalid file format..";	

				}				

		return @$data;	

	}

	function genRandomString($length='') {

		if($length=='')

			{

					    $length =20;				

			}



    $characters = '12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ';

    $string = '';    

    for ($p = 0; $p < $length; $p++) {

        $string .= $characters[mt_rand(0, strlen($characters))];

    }

    return $string;

}

	function deletePage(){

		$this->page_model->deletePage();	

	}

	

	function editpage(){			

		$data['page_content']					=		$this->page_model->getPageData();

		$data['main_content_view']				=		'page/form';

		$this->load->view('default', $data);

	}

	

	function createThumbnails(){

		$config['image_library'] = 'gd2';

		$config['source_image'] = 'uploads/' . $fileName;

		$config['create_thumb'] = TRUE;

		$config['maintain_ratio'] = TRUE;

		$config['width'] = 75;

		$config['height'] = 50;



		$this->load->library('image_lib', $config);

		if(!$this->image_lib->resize()) echo $this->image_lib->display_errors('<p></p>');

	}

	

}