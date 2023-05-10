<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
	function __construct()

	{
		parent::__construct();
		$this->load->helper(array('url',"form"));
		$this->load->library(array("session","form_validation"));
		$this->load->model("common_model");
	}
	public function index()
	{
		$session = $this->session->userdata("login_session");
		
		if(!empty($session))
		{
            $image_data = $this->common_model->image_data($session);
            $this->session->set_flashdata("msg","<div class='alert alert-warning'>Sorry!! You are not authorized for this page. Please contact with Administrator.</div>");
            $data['image_data']= $image_data;
            $this->load->view('list',$data);
		}
		else
		{
			redirect(base_url('login'));
		}
	}

	public function add_image()
	{
		$session = $this->session->userdata("login_session");
        if(!empty($session))
		{
			 $post = $this->input->post();
             
             if(isset($post['save_btn']) && $post['save_btn'] =='Save')
             {
                $filename 	= $_FILES['image']['name'];
                $size       = $_FILES['image']['size'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $size_mb = $size/1000000; //size convert bytes into mb

                if(($ext != 'png') && ($ext != 'jpeg') && ($ext != 'jpg'))
                {
                    $this->session->set_flashdata("msg","<div class='alert alert-danger'>Please select PNG/JPEG/JPG format file.</div>");
                	redirect(base_url('add-image'));
                }
                
                if($size_mb > 10)
                {
                    $this->session->set_flashdata("msg","<div class='alert alert-danger'>Please select file upto 10 MB.</div>");
                	redirect(base_url('add-image'));
                }
                move_uploaded_file($_FILES['image']['tmp_name'],'image/'.$filename);
                $update_data = array(
                	"file_name"		=> $filename,
                	"status"		=> "1",
                    "user_id"       => $session['id'],
                    "file_type"     => $ext,
                    "file_size"     => $size_mb
                );
                $response = $this->common_model->insert(IMAGES,$update_data);
                $last_id = $this->db->insert_id(); 
                $width = 90;
                $height = 50;
                $imageName = $filename;
                if($response)
                {
                    $width = 90;
                    $height = 50;
                    $imageName = $filename;
                    $file = FCPATH.'image/'.$filename;
                    $thumb_nail = $this->resize($width, $height, $imageName,$ext,$file);

                    if($thumb_nail !="")
                    {
                        $imgsize = filesize($thumb_nail);
                        $imgsize_tmp =  $imgsize/1000000; //size convert bytes into mb
                        $update_data1 = array(
                            "image_id"      => $last_id,
                            "file_name"		=> 'thumb_'.$filename,
                            "status"		=> 1,
                            "user_id"       => $session['id'],
                            "file_type"     => $ext,
                            "file_size"     => $imgsize_tmp
                        );

                        $response = $this->common_model->insert(THUMBNAIL_IMAGE,$update_data1);

                        $this->session->set_flashdata("msg","<div class='alert alert-success'>your record has been successfully update.</div>");
                        redirect(base_url('add-image'));
                    }
                }
             }
             else{
                $this->load->view("add_image");
             }
		}
	}

    function resize($width, $height, $imageName,$extension,$file) {
        list($w, $h) = getimagesize($file);
        if(empty($width) || empty($height) || empty($imageName) || empty($extension)){
            die('Required parameter is missing');
        }
        $docRoot = getenv("DOCUMENT_ROOT");
        
        /* Get original image x y */
        $tmpNM = $file;
        
        /* calculate new image size with ratio */
        $ratio = max($width / $w, $height / $h);
        $h = ceil($height / $ratio);
        $x = ($w - $width / $ratio) / 2;
        $w = ceil($width / $ratio);
        /* new file name */
        $path = FCPATH.'/image/thumbnail/thumb_' . $imageName;

        /* read binary data from image file */
        $imgString = file_get_contents($tmpNM);
        /* create image from string */
        $image = imagecreatefromstring($imgString);
        $tmp = imagecreatetruecolor($width, $height);
        imagecopyresampled($tmp, $image, 0, 0, $x, 0, $width, $height, $w, $h);
        $fileTypes = array('jpg', 'jpeg', 'jpe', 'png'); // File extensions
        /* Save image */
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
            case 'jpe':
                imagejpeg($tmp, $path, 100);
                break;
            case 'png':
                imagepng($tmp, $path,0);
                break;
            default:
                exit;
                break;
        }
        return $path;
        /* cleanup memory */
        imagedestroy($image);
        imagedestroy($tmp);
    }

    public function delete()
    {
        $id = $this->uri->segment(2);
        $data = array(
            "is_deleted"    =>'1'
        );
        $this->db->update(IMAGES,$data, array("id" =>$id));
        $this->db->update(THUMBNAIL_IMAGE,$data, array("image_id" => $id));

        $this->session->set_flashdata("msg","<div class='alert alert-danger'>your record has been successfully delete.</div>");
        redirect(base_url('home'));
    }

    
}