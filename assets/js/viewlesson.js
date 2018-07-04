//file url of the pdf
var pdfurl;
// The workerSrc property shall be specified.
PDFJS.workerSrc = url + "vendors/pdfjs/build/pdf.worker.js";

//globals
var pdfDoc = null,
    // pageNum = 1,
    pptPageNum = 1,
    pdfPageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 0.5,
    g_canvas,
    g_pagenum
    

$( document ).ready(function(){
	// $('.select2').select2();
	var body = $('body').attr('id');
	
	if (body == "specificlesson") {
		console.log('specificlesson');
		
		var index = (url + 'teacher/lesson/').length;
		var id = location.href.substring(index);
		console.log(id);
		viewSpecificLesson(id);
		loadEboard('eboard');

		$('#notes').summernote({
			height: 500
		});
		$('#eboard').hide();
	
		$('#cb-vid').on('change', function(){
			var source = $(this).val().replace("%20", " ");
			$('video').html('');
			$('video').attr('src', url + source);
		});

		$('#cb-pdf').on('change', function(){
			pdfPageNum = 1;
			pdfurl = url + $(this).val();
			$('.act-dl').prop('href', pdfurl);
			PDFJS.getDocument(pdfurl).then(function(pdfDoc_) {
				pdfDoc = pdfDoc_;
				document.getElementById('act_page_count').textContent = pdfDoc.numPages;
				g_canvas = "can-pdf";
				g_pagenum = "act_page_num";
				// Initial/first page rendering
				renderPage(pdfPageNum, g_canvas, g_pagenum);
			});
			
		});

		$('#cb-ppt').on('change', function(){
			pptPageNum = 1;
			pdfurl = url + $(this).val();
			$('.ppt-dl').prop('href', pdfurl);
			PDFJS.getDocument(pdfurl).then(function(pdfDoc_) {
				pdfDoc = pdfDoc_;
				document.getElementById('ppt_page_count').textContent = pdfDoc.numPages;
				g_canvas = "can-ppt";
				g_pagenum = "ppt_page_num";
				// Initial/first page rendering
				renderPage(pptPageNum, g_canvas, g_pagenum);
			});
		});

		$('#myTab li a').click(function(){
			// console.log($(this).html());
			var active = $(this).html();
			if (active == "e-Board") {
				$('#eboard').show();
			} else{
				$('#eboard').hide();
			}
		});

		$('.prevpdf').click(function(){
			// console.log(pdfPageNum);
			onPrevPage("pdf", g_canvas, g_pagenum);
		});

		$('.nextpdf').click(function(){
			onNextPage("pdf", g_canvas, g_pagenum);
		});

		$('.prevppt').click(function(){
			// console.log(pptPageNum);
			onPrevPage("ppt", g_canvas, g_pagenum);
		});

		$('.nextppt').click(function(){
			// console.log(pptPageNum);
			onNextPage("ppt", g_canvas, g_pagenum);
		});

		$('.zoomout').click(function(){
			var activeTab = $('#myTab li.active a').html();
			if (scale > 0.5) {
				scale -= 0.5;
			
				if (activeTab == "Presentation") {
					$('#cb-ppt').change();
				} else if (activeTab == "Activity") {
					$('#cb-pdf').change();
				}
			}
		});

		$('.zoomin').click(function(){
			var activeTab = $('#myTab li.active a').html();
			if (scale < 2) {
				scale += 0.5;

				if (activeTab == "Presentation") {
					$('#cb-ppt').change();
				} else if (activeTab == "Activity") {
					$('#cb-pdf').change();
				}
			
			}
		});
	}
});

function viewSpecificLesson(id){
	$.ajax({
		url : url + 'teacher/specificLesson',
		type: "POST",
		data: {x: id},
		dataType: "JSON",
		success: function(msg)
		{
			console.log(msg);
			if (msg.status == 1) {
				$('#view-specific-lesson').html('');
				$('#view-specific-lesson').html(msg.data[0].name);

				getPptByLessonId(msg.data[0].id);
				getVideoByLessonId(msg.data[0].id);
				getPdfByLessonId(msg.data[0].id);
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("delmod " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});	
}

function getPptByLessonId(id){
	$.ajax({
		url : url + 'teacher/getPptByLessonId',
		type: "POST",
		data: {x: id},
		dataType: "JSON",
		success: function(msg)
		{
			if (msg.data != null) {
				$('#cb-ppt').html('');
				$('#cb-ppt').append('<option disabled="true" selected></option>');
				for (var i = 0; i < msg.data.length; i++) {
					// console.log(msg.data[i].filename);
					$('#cb-ppt').append(''+
						'<option value="'+ msg.data[i].filepath +'"> ' + msg.data[i].filename + ' </option>'
					);
				}
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("delmod " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});
}

function getVideoByLessonId(id){
	$.ajax({
		url : url + 'teacher/getVideoByLessonId',
		type: "POST",
		data: {x: id},
		dataType: "JSON",
		success: function(msg)
		{
			if (msg.data != null) {
				$('#cb-vid').html('');
				$('#cb-vid').append('<option disabled="true" selected></option>');
				for (var i = 0; i < msg.data.length; i++) {
					// console.log(msg.data[i].filename);
					$('#cb-vid').append(''+
						'<option value="'+ msg.data[i].filepath +'"> ' + msg.data[i].filename + ' </option>'
					);
				}
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("delmod " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});
}

function getPdfByLessonId(id){
	$.ajax({
		url : url + 'teacher/getPdfByLessonId',
		type: "POST",
		data: {x: id},
		dataType: "JSON",
		success: function(msg)
		{
			if (msg.data != null) {
				$('#cb-pdf').html('');
				$('#cb-pdf').append('<option disabled="true" selected></option>');
				for (var i = 0; i < msg.data.length; i++) {
					// console.log(msg.data[i].filename);
					$('#cb-pdf').append(''+
						'<option value="'+ msg.data[i].filepath +'"> ' + msg.data[i].filename + ' </option>'
					);
				}
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("delmod " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});
}



function renderPage(num, canvas, pagenum) {
	console.log(canvas);
	canvas = document.getElementById(canvas),
	ctx = canvas.getContext('2d');
	// console.log(canvas);
	pageRendering = true;
	// Using promise to fetch the page
	pdfDoc.getPage(num).then(function(page) {
		var viewport = page.getViewport(scale);
		canvas.height = viewport.height;
		canvas.width = viewport.width;

		// Render PDF page into canvas context
		var renderContext = {
			canvasContext: ctx,
			viewport: viewport
		};
		var renderTask = page.render(renderContext);

		// Wait for rendering to finish
		renderTask.promise.then(function() {
			pageRendering = false;
			if (pageNumPending !== null) {
				// New page rendering is pending
				renderPage(pageNumPending);
				pageNumPending = null;
			}
		});
	});

	// Update page counters
	document.getElementById(pagenum).textContent = num;
}


function queueRenderPage(num, canvas, pagenumber) {
  if (pageRendering) {
    pageNumPending = num;
  } else {
  	// console.log(canvas);
    renderPage(num, canvas, pagenumber);
  }
}

function onPrevPage(pageNumVar, canvas, pagenumber) {
   var pageNum;	
  if (pageNumVar == "ppt") {
	  if (pptPageNum <= 1) {
	    return;
	  }
	  pptPageNum--;
	  pageNum = pptPageNum;
  } else{
  	 if (pdfPageNum <= 1) {
	    return;
	  }
	  pdfPageNum--;
	  pageNum = pdfPageNum;
  }
  console.log("onPrevPage: " + pageNumVar + " : " + pageNum);
  queueRenderPage(pageNum, canvas, pagenumber);
}

function onNextPage(pageNumVar, canvas, pagenumber) {
  var pageNum;	
  if (pageNumVar == "ppt") {
	  if (pptPageNum >= pdfDoc.numPages) {
	    return;
	  }
	  pptPageNum++;
	  pageNum = pptPageNum;
  } else{
  	 if (pdfPageNum >= pdfDoc.numPages) {
	    return;
	  }
	  pdfPageNum++;
	  pageNum = pdfPageNum;
  }
  console.log("onNextPage: " + pageNumVar + " : " + pageNum);
  queueRenderPage(pageNum, canvas, pagenumber);
}