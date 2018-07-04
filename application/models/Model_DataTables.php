<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_DataTables extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	/*ALL QUIZZES*/	
		public function allquiz_count(){   
	        $session = $this->session->userdata('logged_in')['rowID'];
	        $query = $this->db
	            ->where('isDeleted', 0)
	            ->where('created_by', $session)
	            ->get('quiz_tbl');
	        return $query->num_rows();  
	    }

		public function allquiz($limit,$start,$col,$dir){   
	       $session = $this->session->userdata('logged_in')['rowID'];
	       $query = $this->db
	                ->where('isDeleted', 0)
	                ->where('created_by',$session)
	                ->limit($limit,$start)
	                ->order_by($col,$dir)
	                ->get('quiz_tbl');
	        if($query->num_rows()>0)
	        {
	            return $query->result(); 
	        }
	        else
	        {
	            return null;
	        }
	    }

	    public function quiz_search($limit,$start,$search,$col,$dir){
	        $session = $this->session->userdata('logged_in')['rowID'];
	        $query = $this->db
	                ->like('quiz_name',$search)
	                ->where('isDeleted', 0)
	                ->where('created_by', $session)
	                ->or_like('quiz_code',$search)
	                ->where('isDeleted', 0)
	                ->where('created_by', $session)
	                ->limit($limit,$start)
	                ->order_by($col,$dir)
	                ->get('quiz_tbl');
	        if($query->num_rows()>0)
	        {
	            return $query->result();  
	        }
	        else
	        {
	            return null;
	        }
	    }
	    
	    public function quiz_search_count($search){
	        $session = $this->session->userdata('logged_in')['rowID'];
	        $query = $this->db
	                ->like('quiz_name',$search)
	                ->where('isDeleted', 0)
	                ->where('created_by', $session)
	                ->or_like('quiz_code',$search)
	                ->where('isDeleted', 0)
	                ->where('created_by', $session)
	                ->get('quiz_tbl');
	        return $query->num_rows();
	    } 	    	    	    
    /*ALL QUIZZES*/

    /*ALL LESSONS*/
		public function alllesson_count(){   
	        $session = $this->session->userdata('logged_in')['rowID'];
	        $query = $this->db
	            ->where('isDeleted', 0)
	            ->where('isRemoved', 0)
	            ->where('created_by', $session)
	            ->get('lesson_tbl');
	        return $query->num_rows();  
	    }    	

	    public function alllesson($limit,$start,$col,$dir){   
	       $session = $this->session->userdata('logged_in')['rowID'];
	       $query = $this->db
	                ->where('isDeleted', 0)
	                ->where('created_by',$session)
	                ->limit($limit,$start)
	                ->order_by($col,$dir)
	                ->get('lesson_tbl');
	        if($query->num_rows()>0)
	        {
	            return $query->result(); 
	        }
	        else
	        {
	            return null;
	        }
	    }

	    public function lesson_search($limit,$start,$search,$col,$dir){
	        $session = $this->session->userdata('logged_in')['rowID'];
	        $query = $this->db
	                ->like('lesson_name',$search)
	                ->where('isDeleted', 0)
	                ->where('created_by', $session)
	                ->or_like('lesson_desc',$search)
	                ->where('isDeleted', 0)
	                ->where('created_by', $session)
	                ->limit($limit,$start)
	                ->order_by($col,$dir)
	                ->get('lesson_tbl');
	        if($query->num_rows()>0)
	        {
	            return $query->result();  
	        }
	        else
	        {
	            return null;
	        }
	    }

	    public function lesson_search_count($search){
	        $session = $this->session->userdata('logged_in')['rowID'];
	        $query = $this->db
	                ->like('lesson_name',$search)
	                ->where('isDeleted', 0)
	                ->where('created_by', $session)
	                ->or_like('lesson_desc',$search)
	                ->where('isDeleted', 0)
	                ->where('created_by', $session)
	                ->get('lesson_tbl');
	        return $query->num_rows();
	    } 	    	    	  
    /*ALL LESSONS*/

    /*ALL MODULES*/
		public function allmodule_count(){   
	        $session = $this->session->userdata('logged_in')['rowID'];
	        $query = $this->db
	            ->where('isDeleted', 0)
	            ->where('delPermanent', 0)
	            ->where('created_by', $session)
	            ->get('module_tbl');
	        return $query->num_rows();  
	    }    	

	    public function allmodule($limit,$start,$col,$dir){   
	       $session = $this->session->userdata('logged_in')['rowID'];
	       $query = $this->db
	                ->where('isDeleted', 0)
	                ->where('delPermanent', 0)
	                ->where('created_by',$session)
	                ->limit($limit,$start)
	                ->order_by($col,$dir)
	                ->get('module_tbl');
	        if($query->num_rows()>0)
	        {
	            return $query->result(); 
	        }
	        else
	        {
	            return null;
	        }
	    }

	    public function module_search($limit,$start,$search,$col,$dir){
	        $session = $this->session->userdata('logged_in')['rowID'];
	        $query = $this->db
	                ->like('mod_name',$search)
	                ->where('isDeleted', 0)
	                ->where('delPermanent', 0)
	                ->where('created_by', $session)
	                ->or_like('mod_desc',$search)
	                ->where('isDeleted', 0)
	                ->where('delPermanent', 0)
	                ->where('created_by', $session)
	                ->limit($limit,$start)
	                ->order_by($col,$dir)
	                ->get('module_tbl');
	        if($query->num_rows()>0)
	        {
	            return $query->result();  
	        }
	        else
	        {
	            return null;
	        }
	    }

	    public function module_search_count($search){
	        $session = $this->session->userdata('logged_in')['rowID'];
	        $query = $this->db
	                ->like('mod_name',$search)
	                ->where('isDeleted', 0)
	                ->where('delPermanent', 0)
	                ->where('created_by', $session)
	                ->or_like('mod_desc',$search)
	                ->where('isDeleted', 0)
	                ->where('delPermanent', 0)
	                ->where('created_by', $session)
	                ->get('module_tbl');
	        return $query->num_rows();
	    }  	    	    	  
    /*ALL MODULES*/

    /*Get Lesson By Module ID*/
    	public function allLessonByModId_count($id){   
	        $session = $this->session->userdata('logged_in')['rowID'];
	        $query = $this->db->select('alt.lesson_id AS id, lt.lesson_name AS lname, lt.lesson_desc AS ldesc')
                ->from('module_lesson_tbl AS alt')
                ->join('lesson_tbl AS lt', 'alt.lesson_id = lt.rowID')
                ->where('alt.module_id', $id)
                ->where('lt.isDeleted', 0)
                ->where('alt.created_by', $session)
                ->where('isLinked', 1)
             	->get();

	        return $query->num_rows();  
        }

		public function allLessonByModId($id,$limit,$start,$col,$dir){   
			$session = $this->session->userdata('logged_in')['rowID'];
	        $query = $this->db->select('alt.lesson_id AS id, lt.lesson_name AS lname, lt.lesson_desc AS ldesc')
                ->from('module_lesson_tbl AS alt')
                ->join('lesson_tbl AS lt', 'alt.lesson_id = lt.rowID')
                ->where('alt.module_id', $id)
                ->where('lt.isDeleted', 0)
                ->where('alt.created_by', $session)
                ->where('isLinked', 1)
            	->get();
	        if($query->num_rows()>0)
	        {
	            return $query->result(); 
	        }
	        else
	        {
	            return null;
	        }
	    }

	    public function lessonByModId_search($id, $limit,$start,$search,$col,$dir){
	    	$session = $this->session->userdata('logged_in')['rowID'];
	        $query = $this->db->select('alt.lesson_id AS id, lt.lesson_name AS lname, lt.lesson_desc AS ldesc')
                ->from('module_lesson_tbl AS alt')
                ->join('lesson_tbl AS lt', 'alt.lesson_id = lt.rowID')
                ->like('lt.lesson_name', $search)
                ->where('alt.module_id', $id)
                ->where('lt.isDeleted', 0)
                ->where('alt.created_by', $session)
                ->where('alt.isLinked', 1)
                ->or_like('lt.lesson_desc', $search)
                ->where('alt.module_id', $id)
                ->where('lt.isDeleted', 0)
                ->where('alt.created_by', $session)
                ->where('alt.isLinked', 1)
                ->limit($limit,$start)
                ->order_by($col,$dir)
            	->get();
	        
	        if($query->num_rows()>0)
	        {
	            return $query->result();  
	        }
	        else
	        {
	            return null;
	        }
	    }
	    
	    public function lessonByModId_search_count($id, $search){
	        $session = $this->session->userdata('logged_in')['rowID'];
	        $query = $this->db->select('alt.lesson_id AS id, lt.lesson_name AS lname, lt.lesson_desc AS ldesc')
                ->from('module_lesson_tbl AS alt')
                ->join('lesson_tbl AS lt', 'alt.lesson_id = lt.rowID')
                ->like('lt.lesson_name', $search)
                ->where('alt.module_id', $id)
                ->where('lt.isDeleted', 0)
                ->where('alt.created_by', $session)
                ->where('alt.isLinked', 1)
                ->or_like('lt.lesson_desc', $search)
                ->where('alt.module_id', $id)
                ->where('lt.isDeleted', 0)
                ->where('alt.created_by', $session)
                ->where('alt.isLinked', 1)
            	->get();
	        return $query->num_rows();
	    }
	/*Get Lesson By Module ID*/    
}