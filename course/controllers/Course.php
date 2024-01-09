<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//controller after login or registration
class Course extends Super_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $data['module'] = 'course';
        $data['template'] = 'course';
        $data['web_title'] = 'Course Content';
        $data['page_header'] = 'Course Content';
        $data['queryModule'] = $this->module_model->get_all_rows('_order');
        //echo $this->db->last_query();
        echo Modules::run('templates/adminLayout', $data);
    }

    function check_quiz_order()
    {
        $this->output->set_content_type('application/json');
        if ($this->input->post('order') <= 0) {
            $this->output->set_output(json_encode(array('status' => "Enter greater than zero")));
        } else {

            $this->quiz_question_model->update_where(array('_order' => $this->input->post('order')), array('id' => $this->input->post('question_id')));
            $this->output->set_output(json_encode(array('status' => 1)));
        }
    }

    function check_order()
    {
        $this->output->set_content_type('application/json');


        if ($this->input->post('module_order') <= 0) {

            $this->output->set_output(json_encode(array('status' => "Enter greater than zero")));
        } else {
            if (strcasecmp($this->input->post('module_type'), 'video') == 0) {
                $my_module = $this->module_video_model;
            }

            if (strcasecmp($this->input->post('module_type'), 'quiz') == 0) {
                $my_module = $this->module_quiz_model;
            }

            if (strcasecmp($this->input->post('module_type'), 'slide') == 0) {
                $my_module = $this->module_slide_model;
            }

            // echo $this->db->last_query();
            // exit;

            $cnt_video = $this->module_video_model->getWhereTotal(array('module_id' => $this->input->post('module_type_id'), '_order' => $this->input->post('module_order'), 'id!=' => $this->input->post('id')));
            // echo $this->db->last_query()."<br>";
            // echo "Video:".$cnt_video."<br>";
            $cnt_slide = $this->module_slide_model->getWhereTotal(array('module_id' => $this->input->post('module_type_id'), '_order' => $this->input->post('module_order'), 'id!=' => $this->input->post('id')));
            // echo $this->db->last_query()."<br>";
            // echo "Slide:".$cnt_slide."<br>";
            $cnt_quiz = $this->module_quiz_model->getWhereTotal(array('module_id' => $this->input->post('module_type_id'), '_order' => $this->input->post('module_order'), 'id!=' => $this->input->post('id')));
            // echo $this->db->last_query()."<br>";
            // echo "Quiz:".$cnt_quiz."<br>";
            // print_pre($_POST);
            // exit;

            $my_module->update_where(array('_order' => $this->input->post('module_order')), array('id' => $this->input->post('id')));
            $this->output->set_output(json_encode(array('status' => 1)));

            // if(($cnt_video + $cnt_slide + $cnt_quiz) == 0){
            //     $my_module->update_where(array('_order'=>$this->input->post('module_order')), array('id'=>$this->input->post('id')));
            //     $this->output->set_output(json_encode(array('status' => 1)));
            // }else{
            //     $this->output->set_output(json_encode(array('status' => "This order is already in use.")));
            // }
        }
    }

    public function add_module($id = NULL)
    {

        if ($id === NULL) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                $this->form_validation->set_rules('module_name', 'Module Name', $this->config->item('form_base') . '|required');

                if ($this->form_validation->run() == TRUE) {
                    $add_module = array(
                        'module_name' => $this->input->post('module_name'),
                        '_order' => $this->input->post('_order'),
                    );

                    $insert_id = $this->module_model->insert($add_module);
                    if ($insert_id) {
                        setFlashMessage('flash_success', 'alert alert-success', 'Successfully added.');
                        redirect(site_url('course/'));
                    } else {
                        setFlashMessage('flash_error', 'alert alert-danger', 'Unable to add.');
                        redirect(site_url('course/'));
                    }
                }
            }

            $data['module'] = 'course';
            $data['template'] = 'add_module';
            $data['web_title'] = "Add Module";
            $data['page_header'] = 'Add Module';
            echo Modules::run('templates/adminLayout', $data);
        } else {
            //$old_query = $this->module_model->fromId($id);
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                $this->form_validation->set_rules('module_name', 'Module Name', $this->config->item('form_base') . '|required');
                if ($this->form_validation->run() == TRUE) {

                    $edit_module = array(
                        'module_name' => $this->input->post('module_name'),
                        '_order' => $this->input->post('_order'),
                    );

                    $new_query = $this->module_model->update_where($edit_module, array('id' => intval($id)));
                    if ($new_query) {
                        setFlashMessage('flash_success', 'alert alert-success', 'Successfully updated.');
                        redirect(site_url('course/'));
                    } else {
                        setFlashMessage('flash_error', 'alert alert-success', 'Successfully updated.');
                        redirect(site_url('course/'));
                    }
                }
            }

            $fresh_query = $this->module_model->fromId($id);
            $data['result'] = $fresh_query;
            $data['module'] = 'course';
            $data['template'] = 'add_module';
            $data['web_title'] = "Edit Module";
            $data['page_header'] = 'Edit Module';
            echo Modules::run('templates/adminLayout', $data);
        }
    }


    function delete_module($id)
    {
        $getQuery = $this->module_model->fromId($id);
        $deleteQuery = $this->module_model->delete($id);
        setFlashMessage('flash_error', 'alert alert-success', 'Successfully deleted');
        redirect(site_url('course/'));
    }

    public function add_modules($module_id, $type, $id = NULL)
    {

        $redirect = false;
        $type = ucwords($type);
        if ($id === NULL) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                //video module
                if (strcasecmp($type, 'video') == 0) {
                    $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                    $this->form_validation->set_rules('title', 'Video title', $this->config->item('form_base') . '|required');
                    $this->form_validation->set_rules('link', 'Video link', $this->config->item('form_base') . '|required');
                    $this->form_validation->set_rules('duration', 'Video duration', $this->config->item('form_base') . '|required');

                    if ($this->form_validation->run() == TRUE) {
                        $uploadData = [];
                        if (!empty($_FILES['video_image']['name'])) {

                            $_FILES['file']['name']     = $_FILES['video_image']['name'];
                            $_FILES['file']['type']     = $_FILES['video_image']['type'];
                            $_FILES['file']['tmp_name'] = $_FILES['video_image']['tmp_name'];
                            $_FILES['file']['error']     = $_FILES['video_image']['error'];
                            $_FILES['file']['size']     = $_FILES['video_image']['size'];

                            // File upload configuration
                            $config['upload_path'] = './assets/uploads';
                            $config['allowed_types'] = 'gif|jpg|jpeg|png';
                            $config['overwrite'] = false;
                            $config['max_size'] = $this->config->item('image_max_size');
                            $config['max_width'] = $this->config->item('image_max_width');
                            $config['max_height'] = $this->config->item('image_max_height');
                            $config['max_filename'] = '100';
                            $config['remove_spaces'] = TRUE;
                            $config['encrypt_name'] = TRUE;
                            $config['quality'] = 100;
                            $this->upload->initialize($config);

                            //Upload file to server

                            if ($this->upload->do_upload('file')) {
                                // Uploaded file data
                                $fileData = $this->upload->data();
                                $uploadData['video_image'] = $fileData['file_name'];
                            } else {
                                echo $this->upload->display_errors();
                            }
                        }

                        $add_module = array_merge(array(
                            'module_id' => intval($module_id),
                            'title' => $this->input->post('title'),
                            'link' => $this->input->post('link'),
                            'duration' => $this->input->post('duration'),
                            'description' => $this->input->post('description')
                        ), $uploadData);

                        $redirect = true;
                        $insert_id = $this->module_video_model->insert($add_module);
                    }
                }

                //slide module
                if (strcasecmp($type, 'slide') == 0) {
                    $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                    $this->form_validation->set_rules('title', 'Slide title', $this->config->item('form_base') . '|required');

                    if ($this->form_validation->run() == TRUE) {

                        if (!empty($_FILES['slide_show']['name'])) {

                            $filesCount = count($_FILES['slide_show']['name']);
                            for ($i = 0; $i < $filesCount; $i++) {
                                $_FILES['file']['name']     = $_FILES['slide_show']['name'][$i];
                                $_FILES['file']['type']     = $_FILES['slide_show']['type'][$i];
                                $_FILES['file']['tmp_name'] = $_FILES['slide_show']['tmp_name'][$i];
                                $_FILES['file']['error']     = $_FILES['slide_show']['error'][$i];
                                $_FILES['file']['size']     = $_FILES['slide_show']['size'][$i];

                                // File upload configuration
                                $config['upload_path'] = './assets/uploads';
                                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                                $config['overwrite'] = false;
                                $config['max_size'] = $this->config->item('image_max_size');
                                $config['max_width'] = $this->config->item('image_max_width');
                                $config['max_height'] = $this->config->item('image_max_height');
                                $config['max_filename'] = '100';
                                $config['remove_spaces'] = TRUE;
                                $config['encrypt_name'] = TRUE;
                                $config['quality'] = 100;
                                $this->upload->initialize($config);

                                //Upload file to server
                                if ($this->upload->do_upload('file')) {
                                    // Uploaded file data
                                    $fileData = $this->upload->data();
                                    $uploadData[] = $fileData['file_name'];
                                    //$uploadData[$i]['file_name'] = $fileData['file_name'];
                                    //$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                                } else {
                                    echo $this->upload->display_errors();
                                }
                            }
                        }
                        $slides = [];
                        if (isset($uploadData) && count($uploadData) >= 1) {
                            $slides = array('slide_show' => serialize($uploadData));
                        }

                        $frm_data = array(
                            'module_id' => intval($module_id),
                            'title' => $this->input->post('title'),
                            'description' => $this->input->post('description'),
                        );
                        $add_module = array_merge($slides, $frm_data);

                        $redirect = true;
                        $insert_id = $this->module_slide_model->insert($add_module);
                    }
                }

                // quiz
                if (strcasecmp($type, 'quiz') == 0) {
                    $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                    $this->form_validation->set_rules('title', 'Video title', $this->config->item('form_base') . '|required');

                    if ($this->form_validation->run() == TRUE) {
                        $add_module = array(
                            'module_id' => intval($module_id),
                            'title' => $this->input->post('title'),
                            'description' => $this->input->post('description')
                        );

                        $redirect = true;
                        $insert_id = $this->module_quiz_model->insert($add_module);
                    }
                }
            }

            if ($redirect) {
                if ($insert_id) {
                    setFlashMessage('flash_success', 'alert alert-success', 'Successfully added.');
                    redirect(site_url('course/'));
                } else {
                    setFlashMessage('flash_error', 'alert alert-danger', 'Unable to add.');
                    redirect(site_url('course/'));
                }
            }
            $moduleQuery = $this->module_model->fromId($module_id);
            $data['module'] = 'course';
            $data['template'] = 'add_module_' . strtolower($type);
            if (strcasecmp($type, 'video') == 0) {
                $web_title = "Add " . $type . " Lesson in "  . $moduleQuery->module_name;
                $page_header = "Add " . $type . " Lesson in " . "<strong>" . $moduleQuery->module_name . "</strong>";
            }elseif (strcasecmp($type, 'quiz') == 0) {
                $web_title = "Add " . $type . " in "  . $moduleQuery->module_name;
                $page_header = "Add " . $type . " in " . "<strong>" . $moduleQuery->module_name . "</strong>";
            }else{
                $web_title = "Add " . $type . " Lesson in "  . $moduleQuery->module_name;
                $page_header = "Add " . $type . " Lesson in " . "<strong>" . $moduleQuery->module_name . "</strong>";
            }

            $data['web_title'] = $web_title;
            $data['page_header'] = $page_header;
            echo Modules::run('templates/adminLayout', $data);
        } else {

            //video module
            if (strcasecmp($type, 'video') == 0) {
                $fresh_query = $this->module_video_model->fromId($id);
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                    $this->form_validation->set_rules('title', 'Video title', $this->config->item('form_base') . '|required');
                    $this->form_validation->set_rules('link', 'Video link', $this->config->item('form_base') . '|required');
                    $this->form_validation->set_rules('duration', 'Video duration', $this->config->item('form_base') . '|required');

                    if ($this->form_validation->run() == TRUE) {
                        $uploadData = [];
                        if (!empty($_FILES['video_image']['name'])) {

                            $_FILES['file']['name']     = $_FILES['video_image']['name'];
                            $_FILES['file']['type']     = $_FILES['video_image']['type'];
                            $_FILES['file']['tmp_name'] = $_FILES['video_image']['tmp_name'];
                            $_FILES['file']['error']     = $_FILES['video_image']['error'];
                            $_FILES['file']['size']     = $_FILES['video_image']['size'];

                            // File upload configuration
                            $config['upload_path'] = './assets/uploads';
                            $config['allowed_types'] = 'gif|jpg|jpeg|png';
                            $config['overwrite'] = false;
                            $config['max_size'] = $this->config->item('image_max_size');
                            $config['max_width'] = $this->config->item('image_max_width');
                            $config['max_height'] = $this->config->item('image_max_height');
                            $config['max_filename'] = '100';
                            $config['remove_spaces'] = TRUE;
                            $config['encrypt_name'] = TRUE;
                            $config['quality'] = 100;
                            $this->upload->initialize($config);

                            //Upload file to server
                            if ($this->upload->do_upload('file')) {
                                // Uploaded file data
                                $fileData = $this->upload->data();
                                $uploadData['video_image'] = $fileData['file_name'];
                            } else {
                                echo $this->upload->display_errors();
                            }
                        }

                        $redirect = true;
                        $frm_data = array_merge($uploadData, array('module_id' => intval($module_id), 'title' => $this->input->post('title'), 'link' => $this->input->post('link'), 'duration' => $this->input->post('duration'), 'description' => $this->input->post('description')));
                        $new_query = $this->module_video_model->update_where($frm_data, array('id' => intval($id), 'module_id' => intval($module_id)));
                    }
                }
            }

            ////slide module
            if (strcasecmp($type, 'slide') == 0) {
                $fresh_query = $this->module_slide_model->fromId($id);
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                    $this->form_validation->set_rules('title', 'Video title', $this->config->item('form_base') . '|required');

                    if ($this->form_validation->run() == TRUE) {
                        if (!empty($_FILES['slide_show']['name'])) {

                            $filesCount = count($_FILES['slide_show']['name']);
                            for ($i = 0; $i < $filesCount; $i++) {
                                $_FILES['file']['name']     = $_FILES['slide_show']['name'][$i];
                                $_FILES['file']['type']     = $_FILES['slide_show']['type'][$i];
                                $_FILES['file']['tmp_name'] = $_FILES['slide_show']['tmp_name'][$i];
                                $_FILES['file']['error']     = $_FILES['slide_show']['error'][$i];
                                $_FILES['file']['size']     = $_FILES['slide_show']['size'][$i];

                                // File upload configuration
                                $config['upload_path'] = './assets/uploads';
                                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                                $config['overwrite'] = false;
                                $config['max_size'] = $this->config->item('image_max_size');
                                $config['max_width'] = $this->config->item('image_max_width');
                                $config['max_height'] = $this->config->item('image_max_height');
                                $config['max_filename'] = '100';
                                $config['remove_spaces'] = TRUE;
                                $config['encrypt_name'] = TRUE;
                                $config['quality'] = 100;
                                $this->upload->initialize($config);

                                //Upload file to server
                                if ($this->upload->do_upload('file')) {
                                    // Uploaded file data
                                    $fileData = $this->upload->data();
                                    $uploadData[] = $fileData['file_name'];
                                    //$uploadData[$i]['file_name'] = $fileData['file_name'];
                                    //$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                                } else {
                                    echo $this->upload->display_errors();
                                }
                            }
                        }
                        $slides = [];
                        if (isset($uploadData) && count($uploadData) >= 1) {
                            $slides = array('slide_show' => serialize($uploadData));
                        }

                        $frm_data = array('module_id' => intval($module_id), 'title' => $this->input->post('title'), 'description' => $this->input->post('description'), '_order' => $this->input->post('_order'));
                        $edit_module = array_merge($slides, $frm_data);

                        $redirect = true;
                        $new_query = $this->module_slide_model->update_where($edit_module, array('id' => intval($id), 'module_id' => intval($module_id)));
                    }
                }
            }

            //quiz module
            if (strcasecmp($type, 'quiz') == 0) {
                $fresh_query = $this->module_quiz_model->fromId($id);
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                    $this->form_validation->set_rules('title', 'Video title', $this->config->item('form_base') . '|required');


                    if ($this->form_validation->run() == TRUE) {
                        $redirect = true;
                        $frm_data = array('module_id' => intval($module_id), 'title' => $this->input->post('title'), 'description' => $this->input->post('description'), '_order' => $this->input->post('_order'));
                        $new_query = $this->module_quiz_model->update_where($frm_data, array('id' => intval($id), 'module_id' => intval($module_id)));
                    }
                }
            }

            if ($redirect) {
                if ($new_query) {
                    setFlashMessage('flash_success', 'alert alert-success', 'Successfully updated.');
                    redirect(site_url('course/'));
                } else {
                    setFlashMessage('flash_error', 'alert alert-success', 'Successfully updated.');
                    redirect(site_url('course/'));
                }
            }

            $moduleQuery = $this->module_model->fromId($module_id);
            $data['result'] = $fresh_query;
            $data['module'] = 'course';
            $data['template'] = 'add_module_' . strtolower($type);

            if (strcasecmp($type, 'video') == 0) {
                $web_title = "Edit " . $type . " Lesson in "  . $moduleQuery->module_name;
                $page_header = "Edit " . $type . " Lesson in " . "<strong>" . $moduleQuery->module_name . "</strong>";
            }elseif (strcasecmp($type, 'quiz') == 0) {
                $web_title = "Edit " . $type . " in "  . $moduleQuery->module_name;
                $page_header = "Edit " . $type . " in " . "<strong>" . $moduleQuery->module_name . "</strong>";
            }else{
                $web_title = "Edit " . $type . " Lesson in "  . $moduleQuery->module_name;
                $page_header = "Edit " . $type . " Lesson in " . "<strong>" . $moduleQuery->module_name . "</strong>";
            }

            $data['web_title'] = $web_title;
            $data['page_header'] = $page_header;

            // $data['web_title'] = "Edit " . $type . " Lesson in module " .  $moduleQuery->module_name;
            // $data['page_header'] = "Edit " . $type . " Lesson in module " . "<strong>" . $moduleQuery->module_name . "</strong>";
            echo Modules::run('templates/adminLayout', $data);
        }
    }

    function delete_slide_picture($module_id, $picture, $slide_id)
    {
        @unlink('./assets/uploads/' . $picture);
        setFlashMessage('flash_success', 'alert alert-success', 'File successfully deleted');
        redirect(site_url('course/add_modules/' . $module_id . "/slide/" . $slide_id));
        exit;

        // $slide = $this->module_slide_model->fromId($id);
        // if(!empty($slide->slide_show)){
        //     @unlink('./assets/uploads/'.$mem->invoice);
        //     $file_id = $this->module_slide_model->update(array('invoice'=>NULL),$group_id);

        //     if($file_id){
        //         setFlashMessage('flash_success', 'alert alert-success', 'File successfully deleted');
        //     }else{
        //         setFlashMessage('flash_error', 'alert alert-error', 'Something went wrong when saving the file, please try again.');
        //     }
        // }
        // redirect(site_url('course/add_modules/'.$this->uri->segment(3)."/slide/".$id));
        // exit;
    }

    function delete_video_picture()
    {
        $module_id = $this->uri->segment(3);
        $video_id = $this->uri->segment(5);
        $video = $this->module_video_model->fromId($video_id);

        @unlink('./assets/uploads/' . $video->video_image);
        setFlashMessage('flash_success', 'alert alert-success', 'File successfully deleted');
        redirect(site_url('course/add_modules/' . $module_id . "/video/" . $video_id));
        exit;
    }

    function delete_modules($module_id, $type, $id)
    {

        //video module
        if (strcasecmp($type, 'video') == 0) {
            $deleteQuery = $this->module_video_model->delete_where(array('id' => intval($id), 'module_id' => intval($module_id)));
            //echo $this->db->last_query();
        }

        //quiz module
        if (strcasecmp($type, 'quiz') == 0) {
            $deleteQuery = $this->module_quiz_model->delete_where(array('id' => intval($id), 'module_id' => intval($module_id)));
            //echo $this->db->last_query();
        }

        //slide module
        if (strcasecmp($type, 'slide') == 0) {
            $getQuery = $this->module_slide_model->get_selected_where(array('id' => intval($id), 'module_id' => intval($module_id)));
            if ($getQuery) {
                foreach ($getQuery->result() as $slideRow) {
                    if (isset($slideRow->slide_show)) {
                        $pictures = unserialize($slideRow->slide_show);
                        if (count($pictures) >= 1) {
                            foreach ($pictures as $picture) {
                                if (@file_exists('./assets/uploads/' . $picture) && !empty($picture)) {
                                    @unlink('./assets/uploads/' . $picture);
                                }
                            }
                        }
                    }
                }
                $deleteQuery = $this->module_slide_model->delete_where(array('id' => intval($id), 'module_id' => intval($module_id)));
            }
        }

        setFlashMessage('flash_error', 'alert alert-success', 'Successfully deleted');
        redirect(site_url('course/'));
    }

    //add question
    public function add_question($module_id, $type, $quiz_id, $id = NULL)
    {

        if ($id === NULL) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                $this->form_validation->set_rules('question', 'question', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('option_a', 'option A', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('option_b', 'option B', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('option_c', 'option C', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('option_d', 'option D', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('correct_ans', 'Correct Ans', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('explanation', 'Explanation', $this->config->item('form_base') . '|required');

                if ($this->form_validation->run() == TRUE) {
                    $add_question = array(
                        'question' => $this->input->post('question'),
                        'option_a' => $this->input->post('option_a'),
                        'option_b' => $this->input->post('option_b'),
                        'option_c' => $this->input->post('option_c'),
                        'option_d' => $this->input->post('option_d'),
                        'module_quiz_id' => $quiz_id,
                        'correct_ans' => $this->input->post('correct_ans'),
                        'explanation' => $this->input->post('explanation'),
                        '_order' => $this->input->post('_order'),
                    );

                    $insert_id = $this->quiz_question_model->insert($add_question);
                    if ($insert_id) {
                        setFlashMessage('flash_success', 'alert alert-success', 'Successfully added.');
                        redirect($this->input->post('back_url'));
                    } else {
                        setFlashMessage('flash_error', 'alert alert-danger', 'Unable to add.');
                        redirect($this->input->post('back_url'));
                    }
                }
            }

            $moduleQuery = $this->module_model->fromId($module_id);
            $data['module_id'] = $module_id;
            $data['quiz_id'] = $quiz_id;
            $data['module'] = 'course';
            $data['template'] = 'add_module_' . $type;
            $data['web_title'] = "Add " . $type . " on module " . $moduleQuery->module_name;
            $data['page_header'] = "Add " . $type . " on module " . $moduleQuery->module_name;
            echo Modules::run('templates/adminLayout', $data);
        } else {
            //$old_query = $this->module_model->fromId($id);
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                $this->form_validation->set_rules('question', 'question', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('option_a', 'option A', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('option_b', 'option B', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('option_c', 'option C', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('option_d', 'option D', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('correct_ans', 'Correct Ans', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('explanation', 'Explanation', $this->config->item('form_base') . '|required');
                if ($this->form_validation->run() == TRUE) {
                    $edit_module = array(
                        'question' => $this->input->post('question'),
                        'option_a' => $this->input->post('option_a'),
                        'option_b' => $this->input->post('option_b'),
                        'option_c' => $this->input->post('option_c'),
                        'option_d' => $this->input->post('option_d'),
                        'module_quiz_id' => $quiz_id,
                        'correct_ans' => $this->input->post('correct_ans'),
                        'explanation' => $this->input->post('explanation'),
                        '_order' => $this->input->post('_order'),
                    );


                    $new_query = $this->quiz_question_model->update_where($edit_module, array('id' => intval($id)));
                    if ($new_query) {
                        setFlashMessage('flash_success', 'alert alert-success', 'Successfully updated.');
                        redirect($this->input->post('back_url'));
                    } else {
                        setFlashMessage('flash_error', 'alert alert-success', 'Successfully updated.');
                        redirect($this->input->post('back_url'));
                    }
                }
            }

            $fresh_query = $this->quiz_question_model->fromId($id);
            $data['module_id'] = $module_id;
            $data['quiz_id'] = $quiz_id;
            $data['result'] = $fresh_query;
            $data['module'] = 'course';
            $data['template'] = 'add_module_quiz';
            $data['web_title'] = "Add Module";
            $data['page_header'] = 'Add Module';


            echo Modules::run('templates/adminLayout', $data);
        }
    }


    function delete_question($id)
    {
        $getQuery = $this->quiz_question_model->fromId($id);
        $deleteQuery = $this->quiz_question_model->delete($id);
        setFlashMessage('flash_error', 'alert alert-success', 'Successfully deleted');
        redirect($this->input->get('back_url'));
    }


    // Add / Edit Quiz Comment
    public function quiz_comment($quiz_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $this->quiz_comment_model->primary_key = 'quiz_id';
            $fresh_query = $this->quiz_comment_model->fromId($quiz_id);
            $flag = false;
            $scores = 0;
            $comments = 0;
            foreach ($this->input->post('scores') as $key_scores => $val_scores) {
                if ($val_scores!='') {
                    $scores++;
                }
            }

            foreach ($this->input->post('comments') as $key_comments => $val_comments) {
                if ($val_comments!='') {
                    $comments++;
                }
            }
            //if (($scores+1 == count($this->input->post('scores'))) && ($comments+1 == count($this->input->post('comments')))) {
                if (($scores>=1) && ($comments>=1)) {
                if ($fresh_query) {
                    $frm_data = array('scores' => serialize($this->input->post('scores')), 'comments' => serialize($this->input->post('comments')));
                    $query = $this->quiz_comment_model->update_where($frm_data, array('quiz_id' => intval($quiz_id)));
                } else {
                    $frm_data = array('quiz_id' => $quiz_id, 'scores' => serialize($this->input->post('scores')), 'comments' => serialize($this->input->post('comments')));
                    $query = $this->quiz_comment_model->insert($frm_data);
                }


                setFlashMessage('flash_error', 'alert alert-success', 'Successfully updated');
            }

            // echo $scores .' '.count($this->input->post('scores'));
            // echo "<br>";
            // echo $comments .' '.count($this->input->post('comments'));
            // exit;


   

            redirect($this->input->post('back_url'));
        }
    }
}
