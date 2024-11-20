<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Config_video extends HX_Controller {

   public $_subj  = 'Video';
   public $_ctrl  = 'config_video';
   public $_tabel = 'printer';
   public $_kunci = 'id_printer';

   public function __construct()
   {
      parent::__construct();
   }



	public function index($offset=null)
	{
	   $load['_judul']='Upload Video';

      $this->view_admin('video', $load);
	}

   public function upload_video(){
    if (isset($_FILES['video']['name']) && $_FILES['video']['name'] != '') {
        unset($config);
        $date = date("ymd");
        $configVideo['upload_path'] = './video';
        $configVideo['max_size'] = '60000';
        $configVideo['allowed_types'] = 'mp4';
        $configVideo['overwrite'] = true;
        $configVideo['remove_spaces'] = TRUE;
        $video_name = $_FILES['video']['name'];
        $configVideo['file_name'] = $video_name;

        $this->load->library('upload', $configVideo);
        $this->upload->initialize($configVideo);
        if(!$this->upload->do_upload('video')) {
            echo $this->upload->display_errors();
        }else{
            $videoDetails = $this->upload->data();
            $data['video_name']= $configVideo['file_name'];
            $data['video_detail'] = $videoDetails;
            redirect('admin/config_video');
        }

    }else{
        echo "Please select a file";
    }
  }

   
}