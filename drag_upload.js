function upload_file(e) {
    e.preventDefault();
    var files = e.dataTransfer.files;
    for (var i = 0; i < files.length; i++) {
        ajax_file_upload(files[i]);
    }
}
   
function file_explorer() {
    document.getElementById('selectfile').click();
}
 
document.getElementById('selectfile').onchange = function() {
    ajax_file_upload(document.getElementById('selectfile').files[0]);
};
 
function ajax_file_upload(file_obj) {
    if(file_obj != undefined) {
        var form_data = new FormData();                  
        form_data.append('file', file_obj);
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "ajax_upload.php", true);
        xhttp.onload = function(event) {
            oOutput = document.querySelector('.files-list');
            if (xhttp.status == 200 && this.responseText != "error") {
                oOutput.innerHTML += ""+ this.responseText +"";
            } else {
                oOutput.innerHTML += "   <li class=\"mdl-list__item\">" +
                    "<span class=\"mdl-list__item-primary-content\">Ocorreu um erro ao carregar arquivo.</span>" +
                "</li>";
            }
        }
  
        xhttp.send(form_data);
    }
}

function formsubmit() {
    var student_name = document.getElementById('student_name').value;
    var student_mail = document.getElementById('student_mail').value;
    var prof_mail = document.getElementById('prof_mail').value;
    
    //store all the submitted data in astring.
    var formdata = 'student_name=' + student_name + '&student_mail=' + student_mail + '&prof_mail=' + prof_mail;
	
	// AJAX code to submit form.
	$.ajax({
		 type: "POST",
		 url: "send.php",
		 data: formdata,
		 cache: false,
		 success: function(html) {
		  //alert(html);
		 }
	});

	return false;
}