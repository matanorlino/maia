var lesname = '';
var lessonid = '';

var pdfDoc = null,
	pageNum = 1,
	pageRendering = false,
	pageNumPending = null,
	scale = 0.8,
	canvas =  null,
	ctx = null; 
	// The workerSrc property shall be specified.
	PDFJS.workerSrc = url + 'vendors/pdfjs/pdf.worker.js';
	
$( document ).ready(function(){
	// $('.select2').select2();
	var body = $('body').attr('id');
	
	if (body == "specificlesson") {
		console.log('specificlesson');
		
		var index = (url + 'teacher/lesson/').length;
		var id = location.href.substring(index);
		
		viewSpecificLesson(id);
		loadEboard('eboard');
	}

	$('#cb-vid').on('change', function(){
		var source = $(this).val().replace("%20", " ");
		$('video').html('');
		$('video').attr('src', url + source);
	});

	$('#cb-pdf').on('change', function(){
		canvas = document.getElementById('can-pdf');
		ctx = canvas.getContext('2d');
		scale = 0.8;
		

		var source = url + $(this).val();
		
		PDFJS.getDocument(source).then(function(pdfDoc_) {
			// pdfDoc = pdfDoc_;
			
			document.getElementById('page_count').textContent = pdfDoc.numPages;

			// Initial/first page rendering
			renderPage(pageNum);
		});
	});

	$('#cb-ppt').on('change', function(){
		var source = $(this).val();
		// window.open(url + source, '_blank');
		// $('#ppt-link').html('');
		// $('#ppt-link').attr('href', url + source);
		// $('#ppt-obj').attr('src', url + source);
		// $('#ppt-obj').attr('height', "500");

		// $('a.embed, #embedURL').html('');
		$('a.embed, #embedURL').attr('href', url + source);
		$('a.embed').zohoViewer({ width: 400, height: 500 });
		$('#embedURL').zohoViewer({ width: 400, height: 500 });

	});
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




/**
 * Get page info from document, resize canvas accordingly, and render page.
 * @param num Page number.
 */
function renderPage(num) {
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
	document.getElementById('page_num').textContent = pageNum;
}

/**
 * If another page rendering in progress, waits until the rendering is
 * finised. Otherwise, executes rendering immediately.
 */
function queueRenderPage(num) {
  if (pageRendering) {
    pageNumPending = num;
  } else {
    renderPage(num);
  }
}

/**
 * Displays previous page.
 */
function onPrevPage() {
  if (pageNum <= 1) {
    return;
  }
  pageNum--;
  queueRenderPage(pageNum);
}
if (document.getElementById('body') == "specificlesson") {
	document.getElementById('prev').addEventListener('click', onPrevPage);
}

/**
 * Displays next page.
 */
function onNextPage() {
  if (pageNum >= pdfDoc.numPages) {
    return;
  }
  pageNum++;
  queueRenderPage(pageNum);
}
if (document.getElementById('body') == "specificlesson") {
	document.getElementById('next').addEventListener('click', onNextPage);
}
