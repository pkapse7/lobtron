<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Need_lib {
    var $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->helper('url');
        // $this->CI->load->model('admin_model', 'am');
        // $this->CI->load->model('public_model', 'pm');
    }

    public function send_mail($to_email, $sub, $msg) {
        $from_email = "email@example.com";
        $this->CI->load->library('email');
        $this->CI->email->from($from_email, 'Charuta Agro Pvt. Ltd.');
        $this->CI->email->to($to_email);
        $this->CI->email->set_mailtype("html");
        $this->CI->email->subject($sub);
        $this->CI->email->message($msg);
        if ($this->CI->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function upload_file($file, $tmp_file, $path) {
        $name = time() . "." . $file;
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if ($ext == "jpg" || $ext == "png" || $ext == "jpeg") {
            move_uploaded_file($tmp_file, $path . $name);
            return $name;
        } else {
            return FALSE;
        }
    }

    public function Upload_resize_file($name, $path) {
        // $name is form field name.
        if ($_FILES[$name]['error'] == 0) {
            //upload and update the file
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            $new_name = time() . '-' . $_FILES[$name]['name'];
            $config['file_name'] = $new_name;
            //$config['max_size'] = '100';// in KB

            $this->CI->load->library('upload', $config);

            if (!$this->CI->upload->do_upload($name)) {
                $this->CI->session->set_flashdata('msg_e', $this->CI->upload->display_errors('', ''));
                return FALSE;
            } else {
                //Image Resizing
                $config['source_image'] = $this->CI->upload->upload_path . $this->CI->upload->file_name;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 500;
                $config['height'] = 500;

                $this->CI->load->library('image_lib', $config);

                if (!$this->CI->image_lib->resize()) {
                    $this->CI->session->set_flashdata('msg_e', $this->CI->image_lib->display_errors('', ''));
                    return FALSE;
                } else {
                    return $this->CI->upload->file_name;
                }
            }
        }
    }

    public function pagination($page_url, $table_name) {
        return $data;
    }

    public function send_sms($mobiles, $message) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://sms.procreations.in/api/sendhttp.php?authkey=183418Aakv3DJ8NR5a093741&mobiles=$mobiles&message=$message&sender=ABCDEF&route=1");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // tell the return not to go to the browser
        $output = curl_exec($ch); // point the data to a variable
        curl_close($ch);
        return $output;
    }

    public function general_pagination($page_url, $table_name, $id_name) {
        $this->CI->load->library('pagination');
        $config = array();
        // $page_url = base_url() . "lawyer_profile_data/lawyer_question";
        $config["base_url"] = $page_url;
        $total_row = $this->CI->am->count($table_name);
        $config["total_rows"] = $total_row;
        $config["per_page"] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->CI->pagination->initialize($config);
        if ($this->CI->uri->segment(3)) {
            $page = ($this->CI->uri->segment(3));
        } else {
            $page = 1;
        }
        $pageStart = ($page * $config["per_page"]) - $config["per_page"];
        $this->CI->pagination->initialize($config);

        $data["page_data"] = $this->CI->am->page_data($config["per_page"], $pageStart, $table_name, $id_name);
        $data["links"] = $this->CI->pagination->create_links();

        return $data;
    }

    public function webpConvert2($file, $compression_quality = 80){
      // check if file exists
      if (!file_exists($file)) {
          return false;
      }
      $file_type = exif_imagetype($file);
      //https://www.php.net/manual/en/function.exif-imagetype.php
      //exif_imagetype($file);
      // 1    IMAGETYPE_GIF
      // 2    IMAGETYPE_JPEG
      // 3    IMAGETYPE_PNG
      // 6    IMAGETYPE_BMP
      // 15   IMAGETYPE_WBMP
      // 16   IMAGETYPE_XBM
      echo '<pre>'; print_r($file);exit;
      $output_file =  $file . '.webp';
      if (file_exists($output_file)) {

          return $output_file;
      }
      if (function_exists('imagewebp')) {
          switch ($file_type) {
              case '1': //IMAGETYPE_GIF
                  $image = imagecreatefromgif($file);
                  break;
              case '2': //IMAGETYPE_JPEG
                  $image = imagecreatefromjpeg($file);
                  break;
              case '3': //IMAGETYPE_PNG
                      $image = imagecreatefrompng($file);
                      imagepalettetotruecolor($image);
                      imagealphablending($image, true);
                      imagesavealpha($image, true);
                      break;
              case '6': // IMAGETYPE_BMP
                  $image = imagecreatefrombmp($file);
                  break;
              case '15': //IMAGETYPE_Webp
                 return false;
                  break;
              case '16': //IMAGETYPE_XBM
                  $image = imagecreatefromxbm($file);
                  break;
              default:
                  return false;
          }
          // Save the image
          $result = imagewebp($image, $output_file, $compression_quality);
          if (false === $result) {
              return false;
          }
          // Free up memory
          imagedestroy($image);
          return $output_file;
      } elseif (class_exists('Imagick')) {
          $image = new Imagick();
          $image->readImage($file);
          if ($file_type === "3") {
              $image->setImageFormat('webp');
              $image->setImageCompressionQuality($compression_quality);
              $image->setOption('webp:lossless', 'true');
          }
          $image->writeImage($output_file);
          return $output_file;
      }
      return false;
  }

}
