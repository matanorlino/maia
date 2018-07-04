$(document).ready(function() {
	
});


function loadAnsKey(){
    table = $('#ansKeyList1').DataTable({ 
		"bLengthChange": true,
		"bFilter": true,
		"bInfo": false,
		"bPaginate": true,
		"bAutoWidth": false,

        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
        	"url": url + 'teacher/loadquizzes',
        	"type": "POST"
        },

        "columnDefs": [
        { 
            "targets": [ -1 ],
            "orderable": true,
        },
        ],

    });
}