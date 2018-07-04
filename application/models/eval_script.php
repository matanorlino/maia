<?
    public function loadToDbase(){
        for ($i=154; $i < 163; $i++) { 
            for ($qCtr=1; $qCtr < 31 ; $qCtr++) { 
                $qDesc = "";

                if ($qCtr == 1){
                    $qDesc = "Does your instructor speak with a modulated voice, clear diction, pronunciation and articulation?";
                } elseif($qCtr == 2){
                    $qDesc = "Does your instructor show effective non-verbal communication like facial expressions and gestures?";
                }elseif($qCtr == 3){
                    $qDesc = "Does your instructor use badly chosen words such as foul languages, etc.?";
                }elseif($qCtr == 4){
                    $qDesc = "How do you rate your instructor's knowledge of the subject matter?";
                }elseif($qCtr == 5){
                    $qDesc = "Is your instructor updated with new developments in his/her area of expertise?";
                }elseif($qCtr == 6){
                    $qDesc = "Does your instructor relate his/her subject to other areas of discipline?";
                }elseif($qCtr == 7){
                    $qDesc = "Does your instructor respond to discipline problems?";
                }elseif($qCtr == 8){
                    $qDesc = "Does your instructor clearly set appropriate instructions and expectations to the class, and firmly implements such instructions?";
                }elseif($qCtr == 9){
                    $qDesc = "Does your instructor ensure that your classroom set-up is conducive to learning?";
                }elseif($qCtr == 10){
                    $qDesc = "Are the materials used in class organized and available?";
                }elseif($qCtr == 11){
                    $qDesc = "Does your instructor check the attendance and punctuality of the students?";
                }elseif($qCtr == 12){
                    $qDesc = "Does your instructor maintain classroom discipline?";
                }elseif($qCtr == 13){
                    $qDesc = "Does your instructor use his/her time in class productively?";
                }elseif($qCtr == 14){
                    $qDesc = "Does your instructor come to class prepared and ready to teach?";
                }elseif($qCtr == 15){
                    $qDesc = "Does your instructor implement instructional goals suitable to your learning needs?";
                }elseif($qCtr == 16){
                    $qDesc = "Does your instructor emphasize the connection of the topics being discussed to your personal improvement, future profession, and your life as a whole?";
                }elseif($qCtr == 17){
                    $qDesc = "Does your instructor use technology-based resources (e.g. PowerPoint presentations, etc.) in the classroom?";
                }elseif($qCtr == 18){
                    $qDesc = "Can you easily approach your instructor for questions and clarifications about your course?";
                }elseif($qCtr == 19){
                    $qDesc = "Does your instructor use other appropriate instructional materials aside from the prescribed reference materials?";
                }elseif($qCtr == 20){
                    $qDesc = "Does your instructor adjust his/her teaching approaches depending on your and your classmates' varying needs and abilities?";
                }elseif($qCtr == 21){
                    $qDesc = "Does your instructor explain the different theories and concepts of the course clearly and thoroughly?";
                }elseif($qCtr == 22){
                    $qDesc = "Does your instructor ask logical, purposeful, and thought-provoking questions?";
                }elseif($qCtr == 23){
                    $qDesc = "How would you rate your instructor's ability to encourage you and your classmates to participate in classroom discussions? (e.g. by asking mentally-stimulating questions)";
                }elseif($qCtr == 24){
                    $qDesc = "Does your instructor monitor and keep an accurate record of your performance?";
                }elseif($qCtr == 25){
                    $qDesc = "How would you rate your instructor's effectiveness in facilitating quizzes and examinations?";
                }elseif($qCtr == 26){
                    $qDesc = "Does your instructor return your corrected examinations, quizzes, exercises, case studies, researches, etc. on time?";
                }elseif($qCtr == 27){
                    $qDesc = "Does your instructor give appropriate feedback without embarrassing the students who commit mistakes?";
                }elseif($qCtr == 28){
                    $qDesc = "Does your instructor provide intervention/remediation/consultation to students having difficulty in learning?";
                }elseif($qCtr == 29){
                    $qDesc = "If you were to compare this instructor with your instructors in STI this term, how would you rate him/her?";
                }elseif($qCtr == 30){
                    $qDesc = "Please write your comments, questions and other thoughts regarding your instructor on the space given.(For ex: his/her mastery of the subject matter, his/her way of delivery, assistance in the learning activities of the class, etc.)";
                }

                for ($ansCtr = 1; $ansCtr <= 6 ; $ansCtr++) { 
                    $ansOption = "";
                    $ansDesc = "";

                    if ($ansCtr == 1){
                        $ansDesc = "never/almost never";
                    } elseif ($ansCtr == 2) {
                        $ansDesc = "seldom";
                    } elseif ($ansCtr == 3) {
                       $ansDesc = "sometimes";
                    } elseif ($ansCtr == 4) {
                        $ansDesc = "often";
                    } elseif ($ansCtr == 5) {
                       $ansDesc = "most of the time";
                    } elseif ($ansCtr == 6) {
                        $ansDesc = "always/almost always";
                    }  

                    if ($qCtr == 29 || $qCtr == 30) {
                        $ansOption = "REQUIRED";        
                    } else{
                        $ansOption = "OPTIONAL";
                    }

                    if ($qCtr != 30) {
                        $ans = array(
                            "eval_id" => 2,
                            "sched_id" => $i,
                            "question_num" => $qCtr,
                            "question_desc" => $qDesc,
                            "answer_type" => "SURVEY",
                            "answer_num" => $ansCtr,
                            "answer_desc" => $ansDesc,
                            "answer_counter" => 0,
                            "answer_tcounter" => 0,
                            "answer_option" => $ansOption
                        );
                        $this->db->insert('eval_question_tbl', $ans);
                    } else{
                       $ans = array(
                            "eval_id" => 2,
                            "sched_id" => $i,
                            "question_num" => $qCtr,
                            "question_desc" => $qDesc,
                            "answer_type" => "COMMENT",
                            "answer_num" => 1,
                            "answer_desc" => " ",
                            "answer_counter" => 0,
                            "answer_tcounter" => 0,
                            "answer_option" => $ansOption
                        );
                        $this->db->insert('eval_question_tbl', $ans);
                        break;
                    }
                }
            }
        }         
    }