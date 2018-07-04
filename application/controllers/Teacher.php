<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends General_DataTables {
	
	public function __construct() {
		// echo FCPATH . '';
		parent::__construct();
		$this->load->model('Main_model', 'main');
		$this->session->set_userdata("url", base_url());
	}

	//LOAD VIEWS FUNCTIONS
	public function index()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url('teacher/login'), 'refresh');
		} else {
			$data = array("title" => "| Dashboard", "view" => "pages/teacher/dashboard");			
			$this->load->view('master_page', $data);
		}
	}

	public function login()
	{
		$data = array("title" => "| Login", "body" => 'login');
		$this->load->view('login', $data);
	}

	public function logout()
	{
		//destroy session
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect(base_url('teacher/login'), 'refresh');
	}

	public function dashboard()
	{
		$data = array(
			"title" => "| Dashboard",
			"view" => "pages/teacher/dashboard",
			"body" => 'dashboard'
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}		
	}
	
	public function allsubject()
	{
		$data = array(
			"title" => "| All Module",
			"view" => "pages/teacher/allsubject",
			"body" => 'allsubject'
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}
	}	

	public function newsubject()
	{
		$data = array(
			"title" => "| New Module",
			"view" => "pages/teacher/newsubject",
			"body" => "newsubject"
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}
	}

	public function alllesson()
	{
		$data = array(
			"title" => "| All Lesson",
			"view" => "pages/teacher/alllesson",
			"body" => 'alllesson'
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}
	}

	public function newlesson()
	{
		$data = array(
			"title" => "| New Lesson",
			"view" => "pages/teacher/newlesson",
			"body" => "newlesson"
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}	
	}

	public function editlesson()
	{
		$data = array(
			"title" => "| Edit Lesson",
			"view" => "pages/teacher/editlesson",
			"body" => "editlesson"
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}	
	}

	public function calendar()
	{
		$data = array(
			"title" => "| Calendar",
			"view" => "pages/teacher/calendar",
			"body" => "calendar"
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}
	}

	public function todo()
	{
		$data = array(
			"title" => "| To Do List",
			"view" => "pages/teacher/todo",
			"body" => "todo"
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}
	}

	public function eboard()
	{
		$data = array(
			"title" => "| E-Board",
			"view" => "pages/teacher/eboard",
			"body" => "teacheboard"
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}
	}

	public function profile()
	{
		$data = array(
			"title" => "| Profile",
			"view" => "pages/teacher/profile",
			"body" => "profile"
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}
	}

	public function subjectlesson()
	{
		$data = array(
			"title" => "| Subject Lesson",
			"view" => "pages/teacher/subjectlesson",
			"body" => "subjlesson"
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}
	}

	public function viewlesson()
	{
		$data = array(
			"title" => "| Lesson",
			"view" => "pages/teacher/viewlesson",
			"body" => "viewlesson"
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}
	}

	public function quiz(){
		$data = array(
			"title" => "| eQuiz",
			"view" => "pages/teacher/quiz",
			"body" => "quiz"
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}
	}

	public function restoremodule(){
		$data = array(
			"title" => "| Restore - Module",
			"view" => "pages/teacher/restoremodule",
			"body" => "restoremodule"
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}
	}

	public function restorelesson(){
		$data = array(
			"title" => "| Restore - Lesson",
			"view" => "pages/teacher/restorelesson",
			"body" => "restorelesson"
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}
	}

	public function teachnow(){
		$data = array(
			"title" => "| Teach Now",
			"view" => "pages/teacher/teachnow",
			"body" => "teachnow"
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}
	}

	public function lesson($lessonid){
		$data = array(
			"title" => "| Lesson",
			"view" => "pages/teacher/lesson",
			"body" => "specificlesson"
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}
	}

	public function calculator(){
		$data = array(
			"title" => "| Calculator",
			"view" => "pages/teacher/calculator",
			"body" => "calculator"
		);
		if (!$this->session->userdata('logged_in')) {
			$this->index();
		} else {
			$this->load->view('master_page', $data);
		}
	}	
	//EXTRA FUNCTIONS

	public function validate_user(){
		$this->_validate_user();
		echo json_encode(array("status" => TRUE));
	}

	private function _validate_user()
	{
		$post = array(
			'username' => $this->input->post('x')[0],
			'password' => $this->input->post('x')[1]
		);

		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		$validate = $this->main->validate_user($post);
		
		if($validate == FALSE)
		{
			$data['inputerror'][] = 'password';
			$data['status'] = FALSE;
		}

		if ($validate == FALSE) {
			$data['inputerror'][] = 'invalid';
			$data['error_string'][] = 'Invalid Email or Password';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	public function register(){
		try {
			$post = array(
				'firstname' => $this->input->post('x')[0],
				'middlename' => $this->input->post('x')[1],
				'lastname' => $this->input->post('x')[2],
				'username' => $this->input->post('x')[3],
				'password' => MD5($this->input->post('x')[4]),
			);

			$this->_register_validate();
			$this->main->createNewUser($post);
			echo json_encode(array("status" => TRUE));
		}
		catch(Exception $e){
			echo json_encode(2);
		}
	}

	private function _register_validate(){
		$post = array(
			'firstname' => $this->input->post('x')[0],
			'middlename' => $this->input->post('x')[1],
			'lastname' => $this->input->post('x')[2],
			'username' => $this->input->post('x')[3],
			'password' => $this->input->post('x')[4],
			'cpassword' => $this->input->post('x')[5],
		);

		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		$validate = $this->main->validateRegUser($post);

		if ($validate == FALSE) {
			$data['inputerror'][] = 'reg_username';
			$data['error_string'][] = 'Username is already in use!';
			$data['status'] = FALSE;
		} else{
			if ($post['firstname'] == "" || trim($post['firstname']) == ""){
				$data['inputerror'][] = 'firstname';
				$data['error_string'][] = 'Firstname is required';
				$data['status'] = FALSE;
			}
			if ($post['lastname'] == "" || trim($post['lastname']) == ""){
				$data['inputerror'][] = 'lastname';
				$data['error_string'][] = 'Lastname is required';
				$data['status'] = FALSE;
			}
			if ($post['username'] == "" || trim($post['username']) == ""){
				$data['inputerror'][] = 'reg_username';
				$data['error_string'][] = 'Username is required';
				$data['status'] = FALSE;
			}
			if ($post['password'] == "" || trim($post['password']) == ""){
				$data['inputerror'][] = 'reg_password';
				$data['error_string'][] = 'Password is required';
				$data['status'] = FALSE;
			}
			if ($post['cpassword'] == "" || trim($post['cpassword']) == ""){
				$data['inputerror'][] = 'reg_cpassword';
				$data['error_string'][] = 'Confirm password is required';
				$data['status'] = FALSE;
			}

			if (trim($post['cpassword']) != trim($post['password'])){
				$data['inputerror'][] = 'reg_cpassword';
				$data['error_string'][] = 'Password did not match';
				$data['status'] = FALSE;
			}
		}

		if ($data['status'] === FALSE){
			echo json_encode($data);
			exit();
		}
	}	

	public function allCount(){
		$data = $this->main->allCount();
		echo json_encode(['data' => $data]);
	}

	public function validateQCode(){
		try {
			$post = $this->input->post('x');
			$qCode = $this->main->validateQuizCode($post);
			if ($qCode == false) {
				echo json_encode("duplicate");
			}else{
				echo json_encode("no-duplicate");
			}
		} catch (Exception $e) {
			echo json_encode("error");
		}
	}

	public function insertQuiz(){
		try {
			$qDetail = $this->input->post('x');
			$qAnswer = $this->input->post('y');
			$this->main->insertQuiz($qDetail, $qAnswer);
			echo json_encode("1");
		} catch (Exception $e) {
			echo json_encode("2");
				
		}
	}

	public function loadquizzes(){
		//load data from general_datatables class
		$json_data = $this->loadallquizzes();
        echo json_encode($json_data); 
	}

	public function deleteQuiz(){
		try {
			$code = $this->input->post('x');
			$this->main->deleteQuiz($code);
			echo json_encode("1");
			
		} catch (Exception $e) {
			echo json_encode("2");
		}
	}

	public function getQuizByCode(){
		$code = $this->input->post('x');
		$quiz = $this->main->getQuizByCode($code);
		$data = [$quiz[0]->quiz_name, $quiz[0]->quiz_code, explode(",", $quiz[0]->quiz_answer), $quiz[0]->date_created];

		echo json_encode(["status" =>"1", "data"=> $data]);
	}

	public function updateQuiz(){
		$code = $this->input->post('x');
		$newAns = $this->input->post('y');
		
		$quiz = $this->main->updateQuiz($code, $newAns);

		echo json_encode($quiz);
	}

	/*TO DO LIST*/
		public function allToDO(){
			$session = $this->session->userdata('logged_in')['username'];
			$todo = $this->main->allToDo($session);
			$data = ['status' => "1", 'data'=> $todo];
			echo json_encode($data);			
		}

		public function insertNewTodo(){
			$session = $this->session->userdata('logged_in')['username'];
			$todo = $this->input->post('x');
			$validate = $todo = $this->main->validateToDo($session, addslashes($todo));

			if ($validate == TRUE) {
				echo json_encode(["status" => "1", "data" => "To Do Description is already existing!"]);
			}else{
				$todo = $this->input->post('x');
				$insert = $this->main->insertToDo($session, $todo);
				if ($insert == "success") {
					echo json_encode(["status" => "2", "data" => "To Do Successfully added!"]);	
				}else{
					echo json_encode(["status" => "3", "data" => "Failed to Insert To Do!"]);	
				}
			}
		}

		public function deleteToDo(){
			try {
				$tdID = $this->input->post('x');
				$this->main->deleteToDo($tdID);
				echo json_encode(["status" => "1", "data" => "To Do Successfully deleted!"]);	
			} catch (Exception $e) {
				echo json_encode(["status" => "2", "data" => $e]);	
			}
		}

		public function toDoById(){
			$tdID = $this->input->post('x');
			$todo = $this->main->toDoById($tdID);
			echo json_encode(["status" => "1", "data" => $todo]);	
		}

		public function saveToDo(){
			$session = $this->session->userdata('logged_in')['username'];
			$data = $this->input->post('x');
			$validate =  $this->main->validateToDo($session, $data[1]);
			
			if ($validate == true) {
				echo json_encode(["status" => "2", "data" => "To Do Description is already existing!"]);
			}else{
				$this->main->saveToDo($data[0], $data[1]);
				echo json_encode(["status" => "1", "data" => "To Do successfully edited!"]);	
			}
		}

		public function checkUncheck(){
			$data = $this->input->post('x');
			$this->main->checkUncheck($data[0], $data[1]);
			echo json_encode(['status' => 1]);
		}
	/*TO DO LIST*/

	/*MODULES*/
		public function createNewMod(){
			$data = $this->input->post('x'); //0 = modname, 1 = moddesc, 2 = modimgpath
			$newmod = $this->main->validateMod($data[0]);

			if ($newmod == false) {
				if ($data[2] == null) {
					$data[2] = '/assets/img/module_img/default.jpg';
				}else{
					$this->image_upload($data);
				}
				if ($data[3] != null) $data[3] = implode(",", $data[3]);
				
				$this->main->insertNewMod($data);
				echo json_encode(['status' => 'success', 'data' => 'Module is successfully created!']);
			}else{
				echo json_encode(['status' => 'duplicate', 'data' => 'Module is already existing!']);
			}
		}

		public function updateModule(){
			$data = $this->input->post('x'); //0 = modname, 1 = moddesc, 2 = modimgpath
			$oldName = $this->input->post('y');
			$json_data = null;
			if ($data[0] != null || $data[0] != '') {
				$validateMod = $this->main->validateMod($data[0]);
				if ($validateMod == false) {
					$this->main->updateModule($oldName, $data);
					$json_data['status'] = 1;
					$json_data['data'] = "success";
				}else{
					$json_data['status'] = 2;
					$json_data['data'] = "duplicate";
				}
			}else{
				$this->main->updateModule($oldName, $data);
					$json_data['status'] = 1;
					$json_data['data'] = "success";
			}
			echo json_encode($json_data);

		}

		public function allModule(){
			$allmod = $this->main->allModule();

			if ($allmod != null) {
				echo json_encode(['status' => 1, 'data' => $allmod]);
			}else{
				echo json_encode(['status' => 2, 'data' => $allmod]);
			}
		}

		public function deleteModule(){
			try {
				$id = $this->input->post('x');
				$this->main->deleteModule($id);
				echo json_encode(['status' => '1', 'data' => 'Module successfully deleted!']);
			} catch (Exception $e) {
				echo json_encode(['status' => '2', 'data' => 'Module unable to delete']);
			}
		}

		public function loadAllLesson(){
			$lessons = $this->loadalllessons();
			echo json_encode($lessons);
		}

		public function getDTModuleById($id){
			$json_data = $this->loadLessonsByModID($id);
			echo json_encode($json_data);
		}

		public function getModuleById(){
			$id = $this->input->post('x');
			$data = $this->main->getModuleById($id);
			$data[0]->mod_day = explode(",", $data[0]->mod_day);
			if ($data != null) {
				echo json_encode(['status' => 1, 'data' => $data]);
			}else{
				echo json_encode(['status' => 2, 'data' => $data]);
			}
		}

		public function removeLink(){
			try {
				$id = $this->input->post('x');
				$query = $this->main->removeLink($id);
				echo json_encode(['status' => '1', 'data' => $query]);
			} catch (Exception $e) {
				echo json_encode(['status' => '2', 'data' => $e]);
			}
		}

		public function addLessonToMod(){
			$post = $this->input->post('x');

			$data = $this->main->addLessonToMod($post);

			if ($data == "success") {
				echo json_encode(['status'=> 1, 'data' => $data]);
			} else{
				echo json_encode(['status'=> 2, 'data' => "error"]);
			}
		}

		public function alldeletedmod(){
			$alldel = $this->main->alldeletedmod();
			echo json_encode(['status' => 1, 'data' => $alldel]);
		}

		public function restorenow(){
			$id = $this->input->post('x');
			$this->main->restorenow($id);
			echo json_encode(['status'=> 1, 'data' => "success"]);
		}

		public function deletePerma(){
			$id = $this->input->post('x');
			$this->main->deletePerma($id);
			echo json_encode(['status'=> 1, 'data' => "success"]);
		}

		public function allDeletePerma(){
			$this->main->allDeletePerma();
			echo json_encode(['status'=> 1, 'data' => "success"]);	
		}
	/*MODULES*/

	/*LESSONS*/
		public function specificLesson(){
			$post = $this->input->post('x');
			// $post = str_replace("%20", " ", $post);
			$json_data = $this->main->specificLesson($post);

			if ($json_data != null) {
				echo json_encode(['status' => 1, 'data' => $json_data]);
			}else{
				echo json_encode(['status' => 2, 'data' => $json_data]);
			}
		}

		public function allActiveLesson(){
			$lessons = $this->main->allLesson();

			if ($lessons != null) {
				echo json_encode(['status' => 1, 'data' => $lessons]);
			}else{
				echo json_encode(['status' => 2, 'data' => $lessons]);
			}
		}
		
		public function createNewLesson(){
			$data = $this->input->post('x');

			$valLesson = $this->main->validateLesson($data[0], $data[3]);

			if ($valLesson == false) {
				if ($data[2] == null) {
					$data[2] = '/assets/img/lesson_img/default.jpg';
				}

				// exit(var_dump( $this->input->post()));
				$this->main->createNewLesson($data);
				echo json_encode(['status'=> 1, 'data' => "success"]);		
			}else{
				if ($valLesson == "duplicate") {
					echo json_encode(['status'=> 2, 'data' => "duplicate"]);		
				} else{
					echo json_encode(['status'=> 3, 'data' => "code is existing"]);
				}
			}
		}

		public function loadAllModules(){
			$modules = $this->loadallmodule();
			echo json_encode($modules);
		}

		public function conLessonToMod(){
			$post = $this->input->post('x');			
			$data = $this->main->connectModToLesson($post);

			if ($data == "success") {
				echo json_encode(['status'=> 1, 'data' => $data]);
			} else{
				echo json_encode(['status'=> 2, 'data' => "error"]);
			}
		}
		
		public function deleteLesson(){
			try {
				$id = $this->input->post('x');
				$this->main->deleteLesson($id);
				echo json_encode(['status' => '1', 'data' => 'Module successfully deleted!']);
			} catch (Exception $e) {
				echo json_encode(['status' => '2', 'data' => 'Module unable to delete']);
			}
		}

		public function delPermaLesson(){
			$this->main->delPermaLesson();
			echo json_encode(['status'=> 1, 'data' => "success"]);	
		}

		public function alldeletedlesson(){
			$alldel = $this->main->alldeletedlesson();
			echo json_encode(['status' => 1, 'data' => $alldel]);
		}

		public function resNowLes(){
			$id = $this->input->post('x');
			$this->main->resNowLes($id);
			echo json_encode(['status'=> 1, 'data' => "success"]);
		}

		public function deletePermaLes(){
			$id = $this->input->post('x');
			$this->main->deletePermaLes($id);
			echo json_encode(['status'=> 1, 'data' => "success"]);
		}
	
	public function upload_ppt($lessonname){
		// $value = $this->input->post();
		$lessonname = str_replace("%20", " ", $lessonname);

		if (!empty($_FILES)) {
			$tempFile = $_FILES['file']['tmp_name'];
			$fileName = $_FILES['file']['name'];

			$path = site_url() . "assets/files/ppt/";

			if(!is_dir($path)){
				mkdir($path, 0777, TRUE);
			}

			$targetPath = getcwd() . '\assets\files\ppt\\';
			
			$fileid = $this->main->getPptId($fileName);

			
			if ($fileid != null) {
				$lessonid = $this->main->getLessonIdByName($lessonname)[0]->rowID;
				$validateFile = $this->main->validatePpt($lessonid, $fileid[0]->id);

				if ($validateFile == null) {
					$this->main->insertPpt($lessonid, $fileid[0]->id);
				}
			}else{
				$editFilename = str_replace("(", "-", $fileName);
				$editFilename = str_replace(")", "-", $editFilename);
				$array = array(
					'file_name' =>  $fileName,
					'file_path' =>  'assets/files/ppt/'. urlencode($editFilename),
					'created_by' =>  $this->session->userdata('logged_in')['rowID']
				);
				
				 $this->db->insert('ppt_tbl', $array);

				$fileid = $this->main->getPptId($fileName);
				$lessonid = $this->main->getLessonIdByName($lessonname)[0]->rowID;

		
				$validateFile = $this->main->validatePpt($lessonid, $fileid[0]->id);

				if ($validateFile == null) {
					$insert = $this->main->insertPpt($lessonid, $fileid[0]->id);
					// exit(var_dump($insert));
				}
			}
			$targetFile = $targetPath . urlencode($editFilename);
			move_uploaded_file($tempFile, $targetFile);

			echo json_encode("ppt success");
		}
	}

	public function upload_pdf($lessonname){
		// $value = $this->input->post();
		$lessonname = str_replace("%20", " ", $lessonname);
		if (!empty($_FILES)) {
			$tempFile = $_FILES['file']['tmp_name'];
			$fileName = $_FILES['file']['name'];

			$path = site_url() . "assets/files/pdf/";

			if(!is_dir($path)){
				mkdir($path, 0777, TRUE);
			}

			$targetPath = getcwd() . '\assets\files\pdf\\';
			$fileid = $this->main->getPdfId($fileName);

			if ($fileid != null) {
				$lessonid = $this->main->getLessonIdByName($lessonname)[0]->rowID;
				$validateFile = $this->main->validatePdf($lessonid, $fileid[0]->id);
				// exit(var_dump($validateFile));
				
				if ($validateFile == null) {
					$this->main->insertPdf($lessonid, $fileid[0]->id);
				}
			}else{
				$editFilename = str_replace("(", "-", $fileName);
				$editFilename = str_replace(")", "-", $editFilename);
				$array = array(
					'file_name' =>  $fileName,
					'file_path' =>  'assets/files/pdf/'. urlencode($editFilename),
					'created_by' =>  $this->session->userdata('logged_in')['rowID']
				);
				$this->db->insert('pdf_tbl', $array);
					$fileid = $this->main->getPdfId($fileName);
					// exit(var_dump($fileid));
					$lessonid = $this->main->getLessonIdByName($lessonname)[0]->rowID;
					
					$validateFile = $this->main->validatePdf($lessonid, $fileid[0]->id);

					if ($validateFile == null) {
						$this->main->insertPdf($lessonid, $fileid[0]->id);
					}
			}
			$targetFile = $targetPath . urlencode($editFilename);
			move_uploaded_file($tempFile, $targetFile);

			echo json_encode("pdf success");
		}
	}

	public function upload_video($lessonname){
		// $value = $this->input->post();
		$lessonname = str_replace("%20", " ", $lessonname);
		if (!empty($_FILES)) {
			$tempFile = $_FILES['file']['tmp_name'];
			$fileName = $_FILES['file']['name'];

			$path = site_url() . "assets/files/vid/";

			if(!is_dir($path)){
				mkdir($path, 0777, TRUE);
			}

			$targetPath = getcwd() . '\assets\files\vid\\';

			$fileid = $this->main->getVideoId($fileName);

			
			if ($fileid != null) {
				$lessonid = $this->main->getLessonIdByName($lessonname)[0]->rowID;
				$validateFile = $this->main->validateVideo($lessonid, $fileid[0]->id);

				if ($validateFile == null) {
					$this->main->insertVideo($lessonid, $fileid[0]->id);
				}
			}else{
				$editFilename = str_replace("(", "-", $fileName);
				$editFilename = str_replace(")", "-", $editFilename);
				$array = array(
					'file_name' =>  $fileName,
					'file_path' =>  'assets/files/vid/'. urlencode($editFilename),
					'created_by' =>  $this->session->userdata('logged_in')['rowID']
				);
				$this->db->insert('video_tbl', $array);

					$fileid = $this->main->getVideoId($fileName);
					$lessonid = $this->main->getLessonIdByName($lessonname)[0]->rowID;
					$validateFile = $this->main->validateVideo($lessonid, $fileid[0]->id);

					if ($validateFile == null) {
						$insert = $this->main->insertVideo($lessonid, $fileid[0]->id);
						// exit(var_dump($insert));
					}
				
			}
			// exit(var_dump($targetPath));
			$targetFile = $targetPath . urlencode($editFilename);
			move_uploaded_file($tempFile, $targetFile);

			echo json_encode("vid success");
		}
	}
	public function removePpt($lessonname){
		$value = $this->input->post('filename');
		$lessonname = str_replace("%20", " ", $lessonname);
		$lessonid = $this->main->getLessonIdByName($lessonname)[0]->rowID;
		
		$this->main->removePpt($value , $lessonid);
		unlink('assets/files/ppt/' . $value);
		echo json_encode("ppt removed");
	}

	public function removePdf($lessonname){
		$value = $this->input->post('filename');
		$lessonname = str_replace("%20", " ", $lessonname);
		$lessonid = $this->main->getLessonIdByName($lessonname)[0]->rowID;

		$this->main->removePdf($value , $lessonid);
		unlink('assets/files/pdf/' . $value);
		echo json_encode("pdf removed");
	}

	public function removeVideo($lessonname){
		$value = $this->input->post('filename');
		$lessonname = str_replace("%20", " ", $lessonname);
		$lessonid = $this->main->getLessonIdByName($lessonname)[0]->rowID;
		
		$this->main->removeVideo($value , $lessonid);
		unlink('assets/files/vid/' . $value);
		echo json_encode("video removed");
	}

	public function retrievePdf(){
		$id = $this->input->post('id');

		$activePdf = $this->main->retrieveActivePdf($id);

		if ($activePdf != null) {
			foreach($activePdf as $file){
				$obj['name'] = $file->filename;
				$obj['size'] = 0;
				if(file_exists('assets/files/pdf/'.$file->filename)){
					$obj['size'] = filesize('assets/files/pdf/'.$file->filename);
				}
				$result[] = $obj;
			}
			echo json_encode($result);
		}else{
			echo json_encode(null);
		}

	}

	public function retrievePpt(){
		$id = $this->input->post('id');

		$activePpt = $this->main->retrieveActivePpt($id);

		if ($activePpt != null) {
			foreach($activePpt as $file){
				$obj['name'] = $file->filename;
				$obj['size'] = 0;
				if(file_exists('assets/files/ppt/'.$file->filename)){
					$obj['size'] = filesize('assets/files/ppt/'.$file->filename);
				}
				$result[] = $obj;
			}
			echo json_encode($result);
		}else{
			echo json_encode(null);
		}

	}

	public function retrieveVideo(){
		$id = $this->input->post('id');

		$activeVideo = $this->main->retrieveActiveVideo($id);

		if ($activeVideo != null) {
			foreach($activeVideo as $file){
				$obj['name'] = $file->filename;
				$obj['size'] = 0;
				if(file_exists('assets/files/vid/'.$file->filename)){
					$obj['size'] = filesize('assets/files/vid/'.$file->filepath);
				}
				$result[] = $obj;
			}
			echo json_encode($result);
		}else{
			echo json_encode(null);
		}
	}	

		public function updateLesson(){
			$post = $this->input->post('x');
			$count = count($post);

			if ($count == 4) {
				if ($post[0] == $post[1]) {
					$data = [
						'lesson_desc' => $post[2]
					];
					$this->main->updateLessonDetails($post[0], $data);
					echo json_encode(['status' => "success"]);
				}else{
					$validate = $this->main->validateUpdate($post[1]);
					if ($validate == null) {
						$data = [
							'lesson_name' => $post[1],
							'lesson_desc' => $post[2]
						];
						$this->main->updateLessonDetails($post[0], $data);
						echo json_encode(['status' => "success"]);
					}else{
						echo json_encode(['status' => "duplicate"]);
					}
				}
			} else {
				$validate = $this->main->validateLessonCode($post[4]);
				// exit(var_dump($validate));
				if ($validate == false) {
					if ($post[0] == $post[1]) {
						$data = [
							'lesson_desc' => $post[2],
							'lesson_code' => $post[4]
						];
						$this->main->updateLessonDetails($post[0], $data);
						echo json_encode(['status' => "success"]);
					}else{
						$validate = $this->main->validateUpdate($post[1]);
						if ($validate == null) {
							$data = [
								'lesson_name' => $post[1],
								'lesson_desc' => $post[2],
								'lesson_code' => $post[4]
							];
							$this->main->updateLessonDetails($post[0], $data);
							echo json_encode(['status' => "success"]);
						}else{
							echo json_encode(['status' => "duplicate"]);
						}
					}					
				} else{
					echo json_encode(['status' => $validate]);
				}
			}
		}
	/*LESSONS*/

	/*TEACH NOW*/
		public function modToday(){
			$data = $this->main->modToday();

			// allModuleToday
			echo json_encode(['status' => 1,'data' => $data]);
		}
	/*TEACH NOW*/	

	/*SPECIFIC LESSON*/
	public function getPptByLessonId(){
		$post = $this->input->post('x');
		$ppt = $this->main->retrieveActivePpt($post);
		echo json_encode(['data' => $ppt]);
	}

	public function getVideoByLessonId(){
		$post = $this->input->post('x');
		$vid = $this->main->retrieveActiveVideo($post);
		echo json_encode(['data' => $vid]);
	}

	public function getPdfByLessonId(){
		$post = $this->input->post('x');
		$pdf = $this->main->retrieveActivePdf($post);
		echo json_encode(['data' => $pdf]);
	}

// 	public function readPpt(){
// 		$ioFactory = 'PhpOffice\\PhpPresentation\\IOFactory';
// 		$oTree = 'PhpOffice\\PhpPresentation\\PhpPptTree';
// 		$oReader = $ioFactory::createReader('PowerPoint2007');
// 		$presentation = $oReader->load(APPPATH . 'test.pptx');

// 		$oTree::__construct($presentation);
// // $oTree = new PhpPptTree($oPHPPresentation);
// // echo $oTree->display();

// 		foreach ($presentation->getAllSlides() as $slide) {
// 			foreach ($slide->getShapeCollection() as $shape) {
				
// 			}
// 		}
// 	}

	/*Profile*/
	public function getProfile(){
		$data = $this->main->getProfile();
		echo json_encode(["data" => $data]);
	}

	public function updateProfile(){
		$post = $this->input->post('x');
		$count = count($post);
	
		if ($count == 6) {
			if ($post[0] == $post[4]) {
				$update = [
					"firstname" => $post[1],
					"middlename" => $post[2],
					"lastname" => $post[3],
				];
				$this->main->updateProfile($update, $post[0], $post[0], $post[5], $post[5]);
				echo json_encode(["data" => "success"]);
				
			} else{
				$newusername = $this->main->checkUsername($post[4]);
				
				if ($newusername > 0) {
					echo json_encode(["data" => "existing username"]);
				} else {
					$update = [
						"firstname" => $post[1],
						"middlename" => $post[2],
						"lastname" => $post[3],
						"username" => $post[4]
					];	
					$this->main->updateProfile($update, $post[0], $post[4], $post[5], $post[5]);
					echo json_encode(["data" => "success"]);
				}	
			}
		} else {
			if ($post[0] == $post[4]) {
				$validate = $this->main->checkUser($post[0], $post[5]);

				if ($validate < 1) {
					echo json_encode(["data" => "invalid"]);
				} else {
					$update = [
						"firstname" => $post[1],
						"middlename" => $post[2],
						"lastname" => $post[3],
						"password" => MD5($post[6])
					];
					$this->main->updateProfile($update, $post[0], $post[0], $post[5], $update["password"]);
					echo json_encode(["data" => "success"]);
				}
			} else{
				$validate = $this->main->checkUser($post[0], $post[5]);
				$newusername = $this->main->checkUsername($post[4]);
				if ($validate < 1) {
					echo json_encode(["data" => "invalid"]);
				} else{
					if ($newusername > 0) {
						echo json_encode(["data" => "existing username"]);
					} else {
						$update = [
							"firstname" => $post[1],
							"middlename" => $post[2],
							"lastname" => $post[3],
							"username" => $post[4],
							"password" => MD5($post[6])
						];	
						$var = $this->main->updateProfile($update, $post[0], $update["username"], $post[5], $update["password"]);
						echo json_encode(["data" => $var]);
					}	
				}
			}
		}
	}
}//end of class