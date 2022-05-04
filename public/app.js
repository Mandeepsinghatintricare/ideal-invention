let token = {};

// Main Output and its function

function viewRegister(){
    $.ajax({
        url:"/register",
        method:"GET",
        success:function(data) {
            $('#mainOutput').html(data);
        }
    });
}

function viewLogin(){
    $.ajax({
        url:"/login",
        method:"GET",
        success:function(data) {
            $('#mainOutput').html(data);
        }
    });
}

function mainRegister(){
    let name = document.getElementById("inline-full-name").value;
    let email = document.getElementById("inline-email").value;
    let password = document.getElementById("inline-password").value;
    var settings = {
        "url": "/api/register",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/json",
        },
        "data": JSON.stringify({
          "name": name,
          "email": email,
          "password": password
        }),
      };
      
      $.ajax(settings).done(function (response) {
        viewLogin()
      });
}

function mainLogin(){
    let email = document.getElementById("inline-email").value;
    let password = document.getElementById("inline-password").value;
    var settings = {
        "url": "/api/login",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/json",
        },
        "data": JSON.stringify({
          "email": email,
          "password": password
        }),
      };
      
      $.ajax(settings).done(function (response) {
        token = response;

        var getUser = {
            "url": "/api/get-user",
            "method": "GET",
            "timeout": 0,
            "headers": {
              "Authorization": "Bearer "+token.token,
            },
          };
          
          $.ajax(getUser).done(function (response) {
            document.getElementById('mainOutput').innerHTML = (response);
          });

      });
      
}

function logout(){
    var settings = {
        "url": "/api/logout",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Authorization": "Bearer "+token.token
        },
      };
      
      $.ajax(settings).done(function (response) {
        window.location.href = "/";
      });
}

// Form Functions

function searchUser(str){
    if(str.length == 0){
        var settings = {
            "url": "api/find/emptyQuery",
            "method": "GET",
            "timeout": 0,
            "headers": {
              "Authorization": "Bearer "+token.token
            },
          };
          
          $.ajax(settings).done(function (response) {
            document.getElementById('output').innerHTML = response;
          });

    }
    else{
        var settings = {
            "url": "api/find/"+str,
            "method": "GET",
            "timeout": 0,
            "headers": {
              "Authorization": "Bearer "+token.token
            },
          };
          
          $.ajax(settings).done(function (response) {
            document.getElementById('output').innerHTML = response;
          });
    }
}

function deleteUser(id){
    let confirmDelete = confirm("Do You Want to delete User Record of user no "+id);
    if (confirmDelete) {
        var settings = {
            "url": "api/delete/"+id,
            "method": "GET",
            "timeout": 0,
            "headers": {
              "Authorization": "Bearer "+token.token
            },
          };
          
          $.ajax(settings).done(function (response) {
            document.getElementById('output').innerHTML = response;
          });
    }
}

function newUserData(){
        console.log("here");
    	let formData = new FormData(document.getElementById("newDataForm"));
    	let formFields = document.getElementById('newDataForm').elements;
		if (formFields['fname'].value.length > 0 && formFields['email'].value.length > 0 && formFields['address'].value.length > 0) {
            $.ajax({
                type: "POST",
                url: "/api/new",
                enctype: 'multipart/form-data',
                processData: false,  // do not process the data as url encoded params
                cache: false,
                headers:{
                    "Authorization": "Bearer "+token.token
                  },
			    contentType: false,
                data: formData,
                success: function(data) {
                      
                    // Ajax call completed successfully
                    // $('tbody').html(data);
                    document.getElementById('output').innerHTML = (data);
                   	alert("Form Submited Successfully");
                    document.getElementById("newDataForm").reset();
                    $('#newModal').modal('hide');
                },
                error: function(data) {
                      
                    // Some error in ajax call
                    alert("Please Use different Email and try again or refresh");
                    // document.getElementById('output').innerHTML = this.responseText;
                }
            });
		}
		else {
			alert("Please Fill Up All Fields");
		}
}

function editData(id){

	$.ajaxSetup({
	    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	}
	});
	let userId = id;
    $.ajax({
        type: "GET",
        url: "api/edit/"+userId,
        headers:{
            "Authorization": "Bearer "+token.token
          },
        success: function(data) {
            // console.log(data);
            let result = ($.parseJSON(data));
            // console.log(result);
            // Ajax call completed successfully
            $('#editModal').modal('show');
            document.getElementById('userId').value = (result['id']);
            document.getElementById('fnameNew').value = (result['fname']);
            document.getElementById('lnameNew').value = (result['lname']);
            document.getElementById('emailNew').value = (result['email']);
            if (result['gender']=="Male") {
            	document.getElementById('maleNew').checked = true;
            }
            else if (result['gender']=="Female") {
            	document.getElementById('femaleNew').checked = true;
            }
            else if (result['gender']=="Others"){
            	document.getElementById('otherNew').checked = true;
            }
            if(result['hobby'].includes('Travelling')){
            	document.getElementById("travellingNew").checked = true;
            }
            if(result['hobby'].includes('Reading')){
            	document.getElementById("readingNew").checked = true;
            }
            if(result['hobby'].includes('Swimming')){
            	document.getElementById("swimmingNew").checked = true;
            }
            document.getElementById('inputAddressNew').value = (result['address']);

			document.getElementById('editImage').src= "image/"+(result['image']);
        },
        error: function(data) {
              
            // Some error in ajax call
            alert("Some Error Occurred");
            // document.getElementById('output').innerHTML = this.responseText;
        }
    });
	// $('#editModal').modal('show');
}

function editUserData(){
    	let formData = new FormData(document.getElementById("editDataForm"));
    	let hobby = [];  
       	$('.newHobby').each(function(){  
            if($(this).is(":checked"))  
            {  
                 hobby.push($(this).val());  
            }  
       }); 
       formData.append('hobby', hobby);
       
        $.ajax({
            type: "POST",
            url: "api/edit",
            enctype: 'multipart/form-data',
            processData: false,  // do not process the data as url encoded params
            cache: false,
            headers:{
                "Authorization": "Bearer "+token.token
              },
		    contentType: false,
            data: formData,
            success: function(data) {
                  
                // console.log(data);
                // Ajax call completed successfully
                document.getElementById('output').innerHTML = (data);
               	alert("Form Updated Successfully");
                document.getElementById("editDataForm").reset();
                $('#editModal').modal('hide');
            },
            error: function(data) {
                  
                // Some error in ajax call
                alert("Some Error Occurred");
                // document.getElementById('output').innerHTML = this.responseText;
            }
        });
}

function readURL(input,imgTarget) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(imgTarget).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function closeEdit(){
	document.getElementById("editDataForm").reset();
}

