console.log('student js');
	var fullAns = new Array;

$(document).ready(function(){
	let item;
	let answers = new Array;
	let fnlAnswer = new Array;
	
/*QUIZ pads*/
	$('.scoring').hide();
	$('#answer_sheet').hide();

	$('#itemSubmit').click(function() {
		item = $('#item').val();
		
		if ($('#name').val() == "" || $('#section').val() == ""){
			swal("Invalid", "Please enter you name and section", "error");
		}
		else if (item > 20) {
			swal("Invalid", "Item should be less than 20 only.", "error");
		}
		else if(item == null || item == 0){
			swal("Invalid", "Please enter a valid item number.", "error");	
		}
		else{
			for (var i = 1; i <= item; i++) {
				$('#answer_sheet').append('<p class="enum">' + i + '. ' +
					'<select id="dd'+ i +'">' + 
						'<option id="opt' + i + ' value=" "> </option>' + 
						'<option id="opt' + i + ' value="A">A</option>' + 
						'<option id="opt' + i + ' value="B">B</option>' + 
						'<option id="opt' + i + ' value="C">C</option>' + 
						'<option id="opt' + i + ' value="D">D</option>' + 
						'<option id="opt' + i + ' value="True">True</option>' + 
						'<option id="opt' + i + ' value="False">False</option>' + 
					'</select>');
				$('#checking_sheet').append('<p class="enum">' + i + '. ' +
					'<select id="cdd'+ i +'">' + 
						'<option id="opt' + i + ' value=" "> </option>' + 
						'<option id="opt' + i + ' value="A">A</option>' + 
						'<option id="opt' + i + ' value="B">B</option>' + 
						'<option id="opt' + i + ' value="C">C</option>' + 
						'<option id="opt' + i + ' value="D">D</option>' + 
						'<option id="opt' + i + ' value="True">True</option>' + 
						'<option id="opt' + i + ' value="False">False</option>' + 
					'</select>');

			}
			$('#answer_sheet').append('<input type="submit" class="btn btn-success" value="Submit" id="passAns">');
			$('#checking_sheet').append('<input type="submit" class="btn btn-success" value="Submit" id="finalAns">');
			$('#setItem').hide();
			$('#answer_sheet').show();
			$('#name, #section').prop('disabled', true);
		}

	});

$("#answer_sheet").on('click', '#passAns', function () {
	swal({
		title: "Are you sure?",
		text: "Please double check your answer.",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, submit it!",
		closeOnConfirm: true
	},
	function(){
		for (var i = 1; i <= 10; i++) {
			var strID = "#dd" + i;
			answers.push($(strID).val());
		}
		$('#answer_sheet').hide();
		$('#checking_sheet').show();

	});
});

$("#checking_sheet").on('click', '#finalAns', function () {
	let correctCtr = 0;
	$('#score').html('');
	$('#rate').html('');
	swal({
		title: "Are you sure?",
		text: "Please double check the correct answer.",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, submit it!",
		closeOnConfirm: true
	},
	function(){
		for (var i = 1; i <= item; i++) {
			var strID = "#cdd" + i;
			fnlAnswer.push($(strID).val());
		}

		for (var i = 1; i <= item; i++) {
			if (fnlAnswer[i] == answers[i]) {
				correctCtr += 1;
			}
		}
		var rate = (((correctCtr / 10) * 50) + 50)
		$('#score').append(correctCtr);
		$('#rate').append(rate + '%');
		$('.scoring').show();
		$('#finalAns').prop('disabled', true);
	});
});

	$('#main1').click(function (){
		showA()
	});

	$('#main2').click(function (){
		showB()
	});

	$('#main3').click(function (){
		showC()
	});

	$('#main4').click(function (){	
		showD()
	});

	$('#sub1, #sub2, #sub3').click(function(){
		if($(this).hasClass('alert-danger')){
			$(this).removeClass('alert-danger');
			showA();
		}
		else if($(this).hasClass('alert-info')){
			$(this).removeClass('alert-info');
			showB();
		}
		else if($(this).hasClass('alert-success')){
			$(this).removeClass('alert-success');
			showC();	
		}
		else if($(this).hasClass('alert-warning')){
			$(this).removeClass('alert-warning');
			showD();	
		}else{}
	})

	$('#epad-tab').click(function () {
		let removeActive = [
			'.eboard-tab', '.emc-tab',
			'#eboard_tab_content', '#emc_tab_content'
		];
		let putActive = ['.epad-tab', '#epad_tab_content'];
		setActive(putActive, removeActive)
	});

	$('#eboard-tab').click(function () {
		let removeActive = [
			'.epad-tab', '.emc-tab',
			'#epad_tab_content', '#emc_tab_content'
		];
		let putActive = ['.eboard-tab', '#eboard_tab_content'];
		setActive(putActive, removeActive)
	});

	$('#emc-tab').click(function () {
		let removeActive = [
			'.epad-tab', '.eboard-tab',
			'#epad_tab_content', '#eboard_tab_content'
		];
		let putActive = ['.emc-tab', '#emc_tab_content'];
		setActive(putActive, removeActive)
	});

	/*QUIZ PAD*/

	/*eQuiz*/
		$('#full-submit').click(function(){
			if ($('#full-name').val().trim() == ""){
				swal('Empty', "Please enter your name", "warning");
			}
			else if($('#full-sec').val().trim() == ""){
				swal('Empty', "Please enter your section", "warning");
			}
			else if($('#full-code').val().trim() == ""){
				swal('Empty', "Please enter the quiz code", "warning");
			}else{
				loadQuizItems($('#full-code').val().trim());
			}
		});

		$("#full_ans_sheet").on('click', '#full-submit-quiz', function () {
			var totCorrect = 0;
			$('#full-score').html('');
			
			swal({
				title: "Are you sure?",
				text: "Please double check the correct answer.",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, submit it!",
				closeOnConfirm: false
			},
			function(){
				var totCorrect = 0;
				for (var i = 0; i < fullAns.length; i++) {
					var selID = "#fas" + (i + 1);
					if (fullAns[i] == $(selID).val()) {
						$(selID).prop('disabled', true);
						totCorrect ++;
					}else{
						$(selID).prop('disabled', true);
					}
				}
				swal("Your score!","You got " + totCorrect + "/" + fullAns.length + " in your quiz!", "success");
				$('#full-submit-quiz').prop('disabled', true);
				$('.full-score').show();
				$('#full-score').html(totCorrect);
			});
			
		});
	/*eQuiz*/
}); //document.ready

function setActive(activeDiv, deactivateDiv){
	for (var i = 0; i < deactivateDiv.length; i++) {
		$(deactivateDiv[i]).removeClass('active');	
	}

	for (var i = 0; i <activeDiv.length ; i++) {
		$(activeDiv[i]).addClass('active');
	}
}


function hideColumn(col1, col2, col3, alrtClass1, alrtClass2, alrtClass3, lt1, lt2, lt3){
	$(col1).hide();	
	$(col2).hide();	
	$(col3).hide();	
	//reset content
	$("#sub1 , #sub2, #sub3").removeClass(alrtClass1, alrtClass2, alrtClass3);
	$("#sub1 , #sub2, #sub3").html('');
	$("#ltr1 , #ltr2, #ltr3").html('');
	//add content
	$('#sub1').addClass(alrtClass1);
	$('#sub2').addClass(alrtClass2);
	$('#sub3').addClass(alrtClass3);
	$('#sub1').html(lt1);
	$('#sub2').html(lt2);
	$('#sub3').html(lt3);
}

function emphasizeCol(col){
	$(col).removeClass('col-md-6 col-xs-6');
	$(col).addClass('col-md-12 col-xs-12');
	$(col).show();
}

function showA(){
	hideColumn('#main2','#main3','#main4',
			'alert-info', 'alert-success', 'alert-warning',
			'B', 'C', 'D');
	emphasizeCol('#main1');
}

function showB(){
	hideColumn('#main1','#main3','#main4',
			'alert-danger', 'alert-success', 'alert-warning',
			'A', 'C', 'D');
	emphasizeCol('#main2');
}

function showC(){
	hideColumn('#main1','#main2','#main4',
			'alert-danger', 'alert-info', 'alert-warning',
			'A', 'B', 'D');
	emphasizeCol('#main3');
}

function showD(){
	hideColumn('#main1','#main2','#main3',
			'alert-danger', 'alert-info', 'alert-success',
			'A', 'B', 'C');
	emphasizeCol('#main4');
}

	/*eQuiz*/
	function loadQuizItems(code){
		$.ajax({
			type: "POST",
			url: url + "student/getQuizAns",
			dataType: "json",
			data: {x: code},
			cache: false,

			beforeSend: function() {},
			success: function(msg) {
				console.log(msg);
				if (msg.status == "0") {
					fullAns = msg.data;
					console.log(fullAns);
					for (var i = 1; i <= msg.data.length; i++) {
						$('#full_ans_sheet').append('<p class="enum">' + i + '. ' +
							'<select id="fas'+ i +'">' + 
								'<option id="fasopt' + i + ' value=" "> </option>' + 
								'<option id="fasopt' + i + ' value="A">A</option>' + 
								'<option id="fasopt' + i + ' value="B">B</option>' + 
								'<option id="fasopt' + i + ' value="C">C</option>' + 
								'<option id="fasopt' + i + ' value="D">D</option>' + 
								'<option id="fasopt' + i + ' value="True">True</option>' + 
								'<option id="fasopt' + i + ' value="False">False</option>' + 
							'</select>');
					}
					$('#full_ans_sheet').append('<input type="submit" class="btn btn-success" value="Submit" id="full-submit-quiz">');
					$('#full-submit').hide();
					$('#full-name, #full-sec, #full-code').prop('disabled', true);	
					$('#full_ans_sheet').show();
				}
				else if(msg.status == "1"){
					swal("Ooops", msg.data, "warning");
				}
				else if(msg.status == "2"){
					swal("Ooops", msg.data, "success");	
				}
				
			},
			error: function(xhr, ajaxOptions, thrownError) { swal("Oops", thrownError, "error"); }
		});
	}
	/*eQuiz*/