<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class General_DataTables extends CI_Controller{

	public function __construct(){	
		$this->CI =& get_instance();
		parent::__construct();
		$this->load->model('Main_model', 'main');
		$this->load->model('Model_DataTables', 'dt');
	}

	public function loadallquizzes(){
		$columns = array( 
            0 =>'quiz_name', 
            1 =>'quiz_code',
            2 =>'date_created'
        );

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  
        $totalData = $this->dt->allquiz_count();
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->dt->allquiz($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->dt->quiz_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->dt->quiz_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
				$nestedData['quiz_name'] = $post->quiz_name;
                $nestedData['quiz_code'] = '<a href="javascript:;" id="q-mod" onClick="showModal('."'". $post->quiz_code ."'".')">' . $post->quiz_code . '</a>';
                $nestedData['date_created'] = date('j M Y h:i a',strtotime($post->date_created));
				

                $action = '<a class="btn btn-danger" href="javascript:;" title="Delete Quiz"
                			onClick="deleteQuiz('." ' ". trim(addslashes($post->quiz_code)) ." ' ".')"><i class="fa fa-trash"></i></a>
                		  <a class="btn btn-warning" href="javascript:;" title="Edit Answer Key"
                		  	onClick="editQuiz('."'". trim(addslashes($post->quiz_code)) ."'".')"><i class="fa fa-pencil"></i></a>';

                $nestedData['action'] = $action;
                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => intval($this->input->post('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
         return $json_data;   
        // echo json_encode($json_data);
	}

    public function loadalllessons(){
        $columns = array( 
            0 =>'rowID', 
            1 =>'lesson_name',
            2 =>'lesson_desc',
            3 =>'date_created'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  
        $totalData = $this->dt->alllesson_count();
            
        $totalFiltered = $totalData; 
            
        if(!empty($this->input->post('search')['value']))
        {            
            $posts = $this->dt->alllesson($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 
            $posts =  $this->dt->lesson_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->dt->lesson_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $nestedData['rowID'] = '<input type="checkbox" id="lesID'. $post->rowID .'"  value="'. $post->rowID .'">';
                $nestedData['lesson_name'] = $post->lesson_name;
                $nestedData['lesson_desc'] = $post->lesson_desc;
                $nestedData['date_created'] = date('j M Y h:i a',strtotime($post->date_created));
                $data[] = $nestedData;
            }
        }
          
        $json_data = array(
                    "draw"            => intval($this->input->post('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
         return $json_data;   
        // echo json_encode($json_data);
    }


    public function loadLessonsByModID($modID){
        $columns = array( 
            0 =>'id',
            1 =>'lname', 
            2 =>'ldesc'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  
        $totalData = $this->dt->allLessonByModId_count($modID);
        // exit(var_dump($totalData));
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->dt->allLessonByModId($modID,$limit,$start,$order,$dir);
        }
        else {
            
            $search = $this->input->post('search')['value']; 
            $posts =  $this->dt->lessonByModId_search($modID,$limit,$start,$search,$order,$dir);

            $totalFiltered = $this->dt->lessonByModId_search_count($modID, $search);
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $nestedData['lesson_name'] = '<a href="lesson/'. $post->id . '">' . $post->lname . '</a>';
                $nestedData['lesson_desc'] = $post->ldesc;
                $nestedData['action'] = '<a href="javascript:;" onClick="removeLink('. $post->id .')"><i class="fa fa-remove"></i></a>';
                $data[] = $nestedData;
            }
        }
          
        $json_data = array(
                    "draw"            => intval($this->input->post('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
         return $json_data;   
        // echo json_encode($json_data);        
    }

    public function loadallmodule(){
        $columns = array( 
            0 =>'rowID', 
            1 =>'mod_name',
            2 =>'mod_desc',
            3 =>'date_created'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  
        $totalData = $this->dt->allmodule_count();
            
        $totalFiltered = $totalData; 


        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->dt->allmodule($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 
            $posts =  $this->dt->module_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->dt->module_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $nestedData['rowID'] = '<input type="checkbox" id="modID'. $post->rowID .'"  value="'. $post->rowID .'">';
                $nestedData['mod_name'] = $post->mod_name;
                $nestedData['mod_desc'] = $post->mod_desc;
                $nestedData['date_created'] = date('j M Y h:i a',strtotime($post->date_created));
                $data[] = $nestedData;
            }
        }
          
        $json_data = array(
                    "draw"            => intval($this->input->post('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
         return $json_data;   
        // echo json_encode($json_data);
    }
}