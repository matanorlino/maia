<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Main_model', 'main');
		$this->session->set_userdata("url", base_url());
	}

	//LOAD VIEWS FUNCTIONS
	public function index()
	{
		$this->lessoncode();
	}

	public function act(){
		$data = array(
			"title" => "| eActivity",
			"body" => "act"
		);
		$this->load->view('pages/student/activitysheet', $data);
	}

	public function lessoncode(){
		$data = array(
			"title" => "| Lesson Code",
			"view" => "pages/student/LessonCode",
			"body" => "lesson"
		);
		$this->load->view('master_stud', $data);
	}		

	public function quiz(){
		$data = array(
			"title" => "| eQuiz",
			"view" => "pages/student/quiz",
			"body" => "studquiz"
		);
		$this->load->view('master_stud', $data);
	}

	public function emc(){
		$data = array(
			"title" => "| eMC",
			"view" => "pages/student/activitysheet",
			"body" => "act"
		);
		$this->load->view('master_stud', $data);
	}

	public function getQuizAns(){
		try {
			$code = $this->input->post('x');
			$answer = $this->main->getQuizAns($code);
			if ($answer !== null) {
				$arr = explode(",", $answer[0]->quiz_answer);
				echo json_encode(array("status" => "0", "data" => $arr));
			}else{
				echo json_encode(array("status" => "1", "data" => "Quiz Not Found!"));
			}
		} catch (Exception $e) {
			echo json_encode(array("status" => "2", "data" => $e));	
		}
	}

	public function calculator(){
		$data = array(
			"title" => "| Calculator",
			"view" => "pages/student/calculator",
			"body" => "calculator"
		);
		$this->load->view('master_stud', $data);
	}	

	public function eboard()
	{
		$data = array(
			"title" => "| E-Board",
			"view" => "pages/student/eboard",
			"body" => "studeboard"
		);
		$this->load->view('master_stud', $data);
	}

	public function getLessonId(){
		$data = $this->input->post('x');

		$id = $this->main->getLessonIdByCode($data);
		echo json_encode(["id" => $id]);
	}

	public function lesson($lessonid){
		$data = array(
			"title" => "| Lesson",
			"view" => "pages/student/lesson",
			"body" => "specificlesson"
		);
		$this->load->view('master_stud', $data);
	}

}
