<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}

	public function validate_user($data){
        $this->db->select('rowID, username, firstname')
             ->where(array('username' => $data['username'], 'password' => MD5($data['password'])));
        $result = $this->db->get('user_tbl');
        if ($result->num_rows() > 0)
        {
            $row = $result->row();
            $dataSet = array (
                "rowID" => $row->rowID,
                "username" => $row->username,
                "firstname" => $row->firstname
                );
            $this->session->set_userdata('logged_in', $dataSet);
            return TRUE;
        } else {
            return FALSE;
        }		
	}

    public function validateRegUser($data){
        $this->db->select('rowID, username')
             ->where(array('username' => $data['username']));

        $result = $this->db->get('user_tbl');     
        if ($result->num_rows() > 0){
            return FALSE;
        } else{
            return TRUE;
        }
    }

    public function createNewUser($data){
        $this->db->insert('user_tbl', $data);
    }

    public function validateQuizCode($code){
        $session = $this->session->userdata('logged_in')['rowID'];
        $this->db->select('quiz_code')
            ->where('isDeleted', 0)
            ->where('quiz_code', $code)
            ->where('created_by', $session);
            $result =  $this->db->get('quiz_tbl');
        if ($result->num_rows() > 0){
            return FALSE;
        } else{
            return TRUE;
        }            
    }

    public function insertQuiz($details, $answer){
        $session = $this->session->userdata('logged_in')['rowID'];
        $arrQuiz = [
            'quiz_name' => $details[0],
            'quiz_code' => $details[1],
            'quiz_answer' => implode(",", $answer),
            'created_by' => $session
        ];
        $this->db->insert('quiz_tbl', $arrQuiz);
        
    }
    
    public function deleteQuiz($code){
        $session = $this->session->userdata('logged_in')['rowID'];
        $this->db->set('isDeleted', 1);
        $this->db->where('quiz_code', $code);
        $this->db->where('created_by', $session);
        $this->db->update('quiz_tbl');
        return $code;
    }

    public function getQuizAns($code){
        $this->db->select('quiz_answer')
            ->where('quiz_code', $code)
            ->where('isDeleted', 0);
        $query = $this->db->get('quiz_tbl');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else{
            return null;
        }
    }

    public function getQuizByCode($code){
        $session = $this->session->userdata('logged_in')['rowID'];
        $this->db->select('quiz_name, quiz_code, quiz_answer, date_created')
            ->where('quiz_code',$code)
            ->where('isDeleted',0)
            ->where('created_by', $session);
        $query = $this->db->get('quiz_tbl');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else{
            return null;
        }
    }

    public function updateQuiz($code, $answer){
        $session = $this->session->userdata('logged_in')['rowID'];
        try {
            $arrQuiz = implode(",", $answer);
            $this->db->set('quiz_answer', $arrQuiz);
            $this->db->where('quiz_code', (string) $code);
            $this->db->where('isDeleted', 0);
            $this->db->where('created_by', $session);
            $this->db->update('quiz_tbl');
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /*TO DO LIST*/
        public function allToDo($name){
            $this->db->select('rowID, isChecked, todo_desc')
                 ->where('isDeleted', 0)
                 ->where('created_by', $name);
            $query = $this->db->get('to_do_tbl');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else{
                return null;
            }
        }

        public function toDoById($id){
            $this->db->select('rowID, isChecked, todo_desc')
                 ->where('isDeleted', 0)
                 ->where('rowID', $id);
            $query = $this->db->get('to_do_tbl');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else{
                return null;
            }
        }

        public function validateToDo($name, $todo){
            $this->db->select('isChecked, todo_desc')
                 ->where('isDeleted', 0)
                 ->where('todo_desc', $todo)
                 ->where('created_by', $name);
            $query = $this->db->get('to_do_tbl');
            if ($query->num_rows() > 0) {
                return true;
            } else{
                return false;
            }   
        }

        public function insertToDo($name, $todo){
            $data = ['created_by' => $name, 'todo_desc'=> $todo];
            $this->db->insert('to_do_tbl', $data);
            return "success";
        }

        public function deleteToDo($id){
            $this->db->set('isDeleted', 1)
            ->where('rowID', $id)
            ->update('to_do_tbl');
        }

        public function saveToDo($id, $desc){
            $this->db->set('todo_desc', $desc)
                ->where('rowID', $id)
                ->update('to_do_tbl');   
        }

        public function checkUncheck($id, $val){
            $this->db->set('isChecked', $val)
                ->where('rowID', $id)
                ->update('to_do_tbl');      
        }
    /*TO DO LIST*/

    /*MODULES*/
        public function validateMod($modName){
            $session = $this->session->userdata('logged_in')['rowID'];
            $this->db->select('rowID')
                 ->where('delPermanent', 0)
                 ->where('mod_name', $modName)
                 ->where('created_by', $session);
            $query = $this->db->get('module_tbl');
            if ($query->num_rows() > 0) {
                return true;
            } else{
                return false;
            }   
        }

        public function insertNewMod($data){
            $session = $this->session->userdata('logged_in')['rowID'];
            $fullData = [
                'mod_name' => $data[0],
                'mod_desc' => $data[1],
                'mod_img_path' => $data[2],
                'mod_day' => $data[3],
                'created_by' => $session
            ];
            $this->db->insert('module_tbl', $fullData);
        }

        public function updateModule($oldname, $data){
            $session = $this->session->userdata('logged_in')['rowID'];
            $modday = null;
            if ($data[3] != null){ 
                $modday = implode(",", $data[3]);
}
            if ($data[0] == null) {
                $this->db->set(['mod_desc' => $data[1], 'mod_day' => $modday])
                ->where('mod_name', $oldname)
                ->where('created_by', $session)
                ->update('module_tbl');
            }else{

                $this->db->set([
                    'mod_desc' => $data[1], 
                    'mod_name' => $data[0], 
                    'mod_day' => $modday])
                ->where('mod_name', $oldname)
                ->where('created_by', $session)
                ->update('module_tbl');
            }
        }

        public function allModule(){
            $session = $this->session->userdata('logged_in')['rowID'];

            $this->db->select('rowID AS id, mod_name AS name, mod_desc AS desc, mod_img_path AS path')
                 ->where('isDeleted', 0)
                 ->where('delPermanent', 0)
                 ->where('created_by', $session);
                 
            $query = $this->db->get('module_tbl');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else{
                return null;
            }
        }

        public function deleteModule($id){
            $this->db->set('isDeleted', 1)
                ->where('rowID', $id)
                ->update('module_tbl');
        }

        public function getLessonByModID($id){
            $session = $this->session->userdata('logged_in')['rowID'];
            $this->db->select('lt.lesson_name AS lname, lt.lesson_desc AS ldesc')
                ->from('module_lesson_tbl AS alt')
                ->join('lesson_tbl AS lt', 'alt.lesson_id = lt.rowID')
                ->where('alt.module_id', $id)
                ->where('alt.created_by', $session)
                ->where('isLinked', 1);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result();
            }else {
                return null;
            }
        }

        public function getModuleById($id){
            $this->db->select('rowID, mod_name, mod_desc, mod_day, date_created')
                ->where('isDeleted', 0)
                ->where('delPermanent', 0)
                ->where('rowID', $id);
            $query = $this->db->get('module_tbl');
            if ($query->num_rows() > 0) {
                return $query->result();
            }else {
                return null;
            }
        }

        public function removeLink($id){
            $this->db->set('isLinked', 0)
            ->where('rowID', $id)
            ->update('module_lesson_tbl');
        }

        public function addLessonToMod($data){
            try {
                $session = $this->session->userdata('logged_in')['rowID'];

                $modID = $this->db->select('rowID')
                    ->where('mod_name', $data[0])
                    ->where('isDeleted', 0)
                    ->where('delPermanent', 0)
                    ->where('created_by', $session)
                    ->get('module_tbl');
                $idResult = $modID->result()[0];    
                for ($i=0; $i < sizeof($data[1]); $i++) { 
                    $mod_les = $this->db->select('rowID, isLinked')
                        ->where('module_id', $idResult->rowID)
                        ->where('lesson_id', $data[1][$i])
                        ->where('created_by', $session)
                        ->get('module_lesson_tbl');

                    if ($mod_les->num_rows() < 1) {
                        $arrMod_Less = [
                            'module_id' => $idResult->rowID,
                            'lesson_id' => $data[1][$i],
                            'created_by' => $session
                        ];
                        $this->db->insert('module_lesson_tbl', $arrMod_Less); 
                    } else{
                        if ($mod_les->result()[0]->isLinked == 0) {
                            $this->db->set('isLinked', 1)
                            ->where('module_id', $idResult->rowID)
                            ->where('lesson_id', $data[1][$i])
                            ->where('created_by', $session)
                            ->update('module_lesson_tbl');
                        }
                    }     
                }
                return "success";
            } catch (Exception $e) {
                return "error";
            }
        }

        public function alldeletedmod(){
            $session = $this->session->userdata('logged_in')['rowID'];

            $query = $this->db
                ->select('rowID AS id, mod_name AS name, mod_desc AS desc, mod_img_path AS path')
                ->where('isDeleted', 1)
                ->where('delPermanent', 0)
                ->where('created_by', $session)
                ->get('module_tbl');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else{
                return null;
            } 
        }

        public function restorenow($id){
            $session = $this->session->userdata('logged_in')['rowID'];
            $this->db->set('isDeleted', 0)
                ->where('rowID', $id)
                ->where('delPermanent', 0)
                ->where('created_by', $session)
                ->update('module_tbl');
        }

        public function deletePerma($id){
            $session = $this->session->userdata('logged_in')['rowID'];
            $this->db->set('delPermanent', 1)
                ->where('isDeleted', 1)
                ->where('rowID', $id)
                ->where('created_by', $session)
                ->update('module_tbl');   
        }

        public function allDeletePerma(){
            $session = $this->session->userdata('logged_in')['rowID'];
            $this->db->set('delPermanent', 1)
                ->where('isDeleted', 1)
                ->where('created_by', $session)
                ->update('module_tbl');      
        }
    /*MODULES*/

    /*LESSONS*/
        public function validateLesson($lessonname, $lessoncode){
            $session = $this->session->userdata('logged_in')['rowID'];
            $this->db->select('rowID')
                 ->where('delPermanent', 0)
                 ->where('lesson_name', $lessonname)
                 ->where('created_by', $session);
            $query = $this->db->get('lesson_tbl');
            if ($query->num_rows() > 0) {
                return "duplicate";
            } else{
                $this->db->select('rowID')
                 ->where('delPermanent', 0)
                 ->where('lesson_code', $lessoncode);
                 
                $query = $this->db->get('lesson_tbl');
                if ($query->num_rows() > 0) {
                    return "code existing";
                } else{
                    return false;
                }
            } 
        }

        public function validateLessonCode($lessoncode){
            $this->db->select('rowID')
                 ->where('delPermanent', 0)
                 ->where('lesson_code', $lessoncode);
                 
                $query = $this->db->get('lesson_tbl');
                if ($query->num_rows() > 0) {
                    return "code existing";
                } else{
                    return false;
                }
        }
        public function createNewLesson($data){
            $session = $this->session->userdata('logged_in')['rowID'];
            $arr = [
                'lesson_name' => $data[0],
                'lesson_desc' => $data[1],
                'lesson_img_path' => $data[2],
                'lesson_code' => $data[3],
                'created_by' => $session
            ];
            $this->db->insert('lesson_tbl', $arr);
        }

        public function connectModToLesson($data){
            try {
                $session = $this->session->userdata('logged_in')['rowID'];

                $lesID = $this->db->select('rowID')
                    ->where('lesson_name', $data[0])
                    ->where('isDeleted', 0)
                    ->where('delPermanent', 0)
                    ->where('created_by', $session)
                    ->get('lesson_tbl');
                $idResult = $lesID->result()[0];    
                for ($i=0; $i < sizeof($data[1]); $i++) { 
                    $mod_les = $this->db->select('rowID, isLinked')
                        ->where('module_id', $data[1][$i])
                        ->where('lesson_id', $idResult->rowID)
                        ->where('created_by', $session)
                        ->get('module_lesson_tbl');

                    if ($mod_les->num_rows() < 1) {
                        //if lesson is not yet on the module, insert
                        $arrMod_Less = [
                            'module_id' => $data[1][$i],
                            'lesson_id' => $idResult->rowID,
                            'created_by' => $session
                        ];
                        $this->db->insert('module_lesson_tbl', $arrMod_Less); 
                    } else{
                        //if lesson is already in the module, update
                        if ($mod_les->result()[0]->isLinked == 0) {
                            $this->db->set('isLinked', 1)
                            ->where('module_id', $data[1][$i])
                            ->where('lesson_id', $idResult->rowID)
                            ->where('created_by', $session)
                            ->update('module_lesson_tbl');
                        }
                    }     
                }
                return "success";
            } catch (Exception $e) {
                return "error";
            }
        }

        public function allLesson(){
            $session = $this->session->userdata('logged_in')['rowID'];

            $this->db->select('rowID AS id, lesson_name AS name, lesson_desc AS desc, lesson_img_path AS path, lesson_code AS lessoncode')
                 ->where('isDeleted', 0)
                 ->where('delPermanent', 0)
                 ->where('created_by', $session);
            
            $query = $this->db->get('lesson_tbl');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else{
                return null;
            }
        }

        public function specificLesson($id){
            // $session = $this->session->userdata('logged_in')['username'];

            $this->db->select('rowID AS id, lesson_name AS name, lesson_desc AS desc, lesson_code AS code, lesson_img_path AS path')
                 ->where('rowID', $id)
                 ->where('isDeleted', 0)
                 ->where('delPermanent', 0);
                 // ->where('created_by', $session);
            
            $query = $this->db->get('lesson_tbl');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else{
                return null;
            }
        }

        public function getLessonIdByName($name){
            $session = $this->session->userdata('logged_in')['rowID'];

            $this->db->select('rowID')
                 ->where('lesson_name', $name)
                 ->where('isDeleted', 0)
                 ->where('delPermanent', 0)
                 ->where('created_by', $session);
            
            $query = $this->db->get('lesson_tbl');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else{
                return null;
            }
        }

        public function validatePpt($lessonId, $fileId){
            $session = $this->session->userdata('logged_in')['rowID'];
            $this->db->select('rowID')
                 ->where('lesson_id', $lessonId)
                 ->where('ppt_id', $fileId)
                 ->where('isDeleted', 0)
                 ->where('created_by', $session);
            
            $query = $this->db->get('lesson_files_tbl');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else{
                return null;
            }
        }

        public function validatePdf($lessonId, $fileId){
            $session = $this->session->userdata('logged_in')['rowID'];
            $this->db->select('rowID')
                 ->where('lesson_id', $lessonId)
                 ->where('pdf_id', $fileId)
                 ->where('isDeleted', 0)
                 ->where('created_by', $session);
            
            $query = $this->db->get('lesson_files_tbl');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else{
                return null;
            }
        }

        public function validateVideo($lessonId, $fileId){
            $session = $this->session->userdata('logged_in')['rowID'];
            $this->db->select('rowID')
                 ->where('lesson_id', $lessonId)
                 ->where('video_id', $fileId)
                 ->where('isDeleted', 0)
                 ->where('created_by', $session);
            
            $query = $this->db->get('lesson_files_tbl');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else{
                return null;
            }
        }

        public function insertPpt($lessonid, $fileid){
            $session = $this->session->userdata('logged_in')['rowID'];
            $array = [
                'lesson_id' => $lessonid, 
                'ppt_id' => $fileid,
                'created_by' => $session
            ];

            $this->db->insert('lesson_files_tbl', $array);
        }

        public function insertPdf($lessonid, $fileid){
            $session = $this->session->userdata('logged_in')['rowID'];
            $array = [
                'lesson_id' => $lessonid, 
                'pdf_id' => $fileid,
                'created_by' => $session
            ];

            $this->db->insert('lesson_files_tbl', $array);
        }

        public function insertVideo($lessonid, $fileid){
            $session = $this->session->userdata('logged_in')['rowID'];
            $array = [
                'lesson_id' => $lessonid, 
                'video_id' => $fileid,
                'created_by' => $session
            ];

            $this->db->insert('lesson_files_tbl', $array);
        }

        public function removePpt($name, $lessonid){
            $session = $this->session->userdata('logged_in')['rowID'];
            $pptid = $this->db
                    ->select('rowID AS id')
                    ->where('file_name', $name)
                    ->where('created_by', $session)
                    ->get('ppt_tbl');

            $this->db->set('isDeleted', 1)
                ->where('ppt_id', $pptid->result()[0]->id)
                ->where('created_by', $session)
                ->update('lesson_files_tbl');
        }

        public function removePdf($name, $lessonid){
            $session = $this->session->userdata('logged_in')['rowID'];
            $pdfid = $this->db
                    ->select('rowID AS id')
                    ->where('file_name', $name)
                    ->where('created_by', $session)
                    ->get('pdf_tbl');

            $this->db->set('isDeleted', 1)
                ->where('pdf_id', $pdfid->result()[0]->id)
                ->where('created_by', $session)
                ->update('lesson_files_tbl');
        }

        public function removeVideo($name, $lessonid){
            $session = $this->session->userdata('logged_in')['rowID'];
            $videoid = $this->db
                    ->select('rowID AS id')
                    ->where('file_name', $name)
                    ->where('created_by', $session)
                    ->get('video_tbl');

            $this->db->set('isDeleted', 1)
                ->where('video_id', $videoid->result()[0]->id)
                ->where('created_by', $session)
                ->update('lesson_files_tbl');
        }

        public function deleteLesson($id){
            $this->db->set('isDeleted', 1)
                ->where('rowID', $id)
                ->update('lesson_tbl');
        }

        public function delPermaLesson(){
            $session = $this->session->userdata('logged_in')['rowID'];
            $this->db->set('delPermanent', 1)
                ->where('isDeleted', 1)
                ->where('created_by', $session)
                ->update('lesson_tbl');      
        }

        public function alldeletedlesson(){
            $session = $this->session->userdata('logged_in')['rowID'];

            $query = $this->db
                ->select('rowID AS id, lesson_name AS name, lesson_desc AS desc, lesson_img_path AS path')
                ->where('isDeleted', 1)
                ->where('delPermanent', 0)
                ->where('created_by', $session)
                ->get('lesson_tbl');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else{
                return null;
            } 
        }

        public function resNowLes($id){
            $session = $this->session->userdata('logged_in')['rowID'];
            $this->db->set('isDeleted', 0)
                ->where('rowID', $id)
                ->where('delPermanent', 0)
                ->where('created_by', $session)
                ->update('lesson_tbl');
        }

        public function deletePermaLes($id){
            $session = $this->session->userdata('logged_in')['rowID'];
            $this->db->set('delPermanent', 1)
                ->where('isDeleted', 1)
                ->where('rowID', $id)
                ->where('created_by', $session)
                ->update('lesson_tbl');   
        }

        public function getPptId($filename){
            $session = $this->session->userdata('logged_in')['rowID'];
            $query = $this->db
                ->select('rowID AS id')
                ->where('file_name', $filename)
                ->where('created_by', $session)
                ->get('ppt_tbl');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else{
                return null;
            }
        }

        public function getPdfId($filename){
            $session = $this->session->userdata('logged_in')['rowID'];
            $query = $this->db
                ->select('rowID AS id')
                ->where('file_name', $filename)
                ->where('created_by', $session)
                ->get('pdf_tbl');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else{
                return null;
            }
        }

        public function getVideoId($filename){
            $session = $this->session->userdata('logged_in')['rowID'];
            $query = $this->db
                ->select('rowID AS id')
                ->where('file_name', $filename)
                ->where('created_by', $session)
                ->get('video_tbl');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else{
                return null;
            }
        }

        public function retrieveActivePdf($lessonId){
            // $session = $this->session->userdata('logged_in')['username'];

            $this->db->select('pdf.file_name AS filename, pdf.file_path AS filepath')
                ->from('lesson_files_tbl AS lft')
                ->join('pdf_tbl AS pdf', 'lft.pdf_id = pdf.rowID')
                ->where('lft.lesson_id', $lessonId)
                // ->where('lft.created_by', $session)
                ->where('isDeleted', 0);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result();
            }else {
                return null;
            }
        }

        public function retrieveActivePpt($lessonId){
            // $session = $this->session->userdata('logged_in')['username'];

            $this->db->select('ppt.file_name AS filename, ppt.file_path AS filepath')
                ->from('lesson_files_tbl AS lft')
                ->join('ppt_tbl AS ppt', 'lft.ppt_id = ppt.rowID')
                ->where('lft.lesson_id', $lessonId)
                // ->where('lft.created_by', $session)
                ->where('isDeleted', 0);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result();
            }else {
                return null;
            }
        }

        public function retrieveActiveVideo($lessonId){
            // $session = $this->session->userdata('logged_in')['username'];

            $this->db->select('video.file_name AS filename, video.file_path AS filepath')
                ->from('lesson_files_tbl AS lft')
                ->join('video_tbl AS video', 'lft.video_id = video.rowID')
                ->where('lft.lesson_id', $lessonId)
                // ->where('lft.created_by', $session)
                ->where('isDeleted', 0);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result();
            }else {
                return null;
            }
        }

        public function validateUpdate($newname){
            $session = $this->session->userdata('logged_in')['rowID'];

            $this->db->select('rowId')
                ->where('lesson_name', $newname)
                ->where('created_by', $session)
                ->where('delPermanent', 0);
            $query = $this->db->get('lesson_tbl');

            if ($query->num_rows() > 0) {
                return $query->result();
            }else {
                return null;
            }
        }
        public function updateLessonDetails($formername, $data){
            $session = $this->session->userdata('logged_in')['rowID'];
            $this->db->set($data)
                ->where('lesson_name', $formername)
                ->where('created_by', $session)
                ->update('lesson_tbl');   
        }
    /*LESSONS*/

    /*TEACH NOW*/
        public function modToday(){
            $day =  date('l');
            $session = $this->session->userdata('logged_in')['rowID'];

            $this->db->select('rowID AS id, mod_name AS name, mod_desc AS desc, mod_img_path AS path')
                 ->like('mod_day', $day, 'before')
                 ->where('isDeleted', 0)
                 ->where('delPermanent', 0)
                 ->where('created_by', $session)
                 ->or_like('mod_day',$day, 'after')
                 ->where('isDeleted', 0)
                 ->where('delPermanent', 0)
                 ->where('created_by', $session);
            $query = $this->db->get('module_tbl');
            if ($query->num_rows() > 0) {
                return $query->result();
            } else{
                return null;
            }
        }   
    /*TEACH NOW*/

    /*PROFILE*/

        public function getProfile(){
            $session = $this->session->userdata('logged_in')['username'];
            $this->db->select('rowID AS id, username, password, firstname, middlename, lastname')
                 ->where(array('username' => $session));
            $result = $this->db->get('user_tbl');
            if ($result->num_rows() > 0)
            {
                return $result->result();
            } else {
                return null;
            }
        }
    /*PROFILE*/



    /*STUDENT SIDE*/
    public function getLessonIdByCode($code){
        $this->db->select('rowID')
             ->where('lesson_code', $code)
             ->where('isDeleted', 0)
             ->where('delPermanent', 0);
        $query = $this->db->get('lesson_tbl');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else{
            return null;
        }
    }

    public function allCount(){
        $session = $this->session->userdata('logged_in')['rowID'];
        //lesson count
        $lesson = $this->db->where('delPermanent', 0)->where('created_by', $session)->get('lesson_tbl');
        ($lesson->num_rows() > 0) ? $lesson = $lesson->num_rows() : $lesson = 0;

        //module count
        $module = $this->db->where('delPermanent', 0)->where('created_by', $session)->get('module_tbl');
        ($module->num_rows() > 0) ? $module = $module->num_rows() : $module = 0;

        $arrData = [
            'lesson' => $lesson,
            'module' => $module
        ];
        return $arrData;
    }

    public function checkUser($username, $password){
        $user = $this->db->select('rowId')->where(['username' => $username, 'password' => MD5($password)])->get('user_tbl');
        return $user->num_rows();
    }

    public function checkUsername($username){
        $user = $this->db->select('rowId')->where(['username' => $username])->get('user_tbl');
        return $user->num_rows();   
    }

    public function updateProfile($update, $oldusername, $newusername, $oldpassword, $newpassword){

        $this->db->set($update)
        ->where('username', $oldusername)
        ->where('password', MD5($oldpassword))
        ->update('user_tbl'); 

        $data = ['username' => $newusername, 'password' => $newpassword];
        $var =  $this->validate_user($data);
       
    }

}// end of class