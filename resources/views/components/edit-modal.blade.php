@props(['user'])
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Enter Your Details</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form id="editDataForm" action="" method="POST" enctype="multipart/form-data">
	        @csrf
	        	<div class="form-row">
	        		<div class="form-group">
	                	<input id="userId" name="userId" type="text" class="form-control" placeholder="userId" readonly style="display: none;">
	            	</div>
	        	</div>
	          <div class="form-row">
	            <div class="form-group col-md-6">
	                <input id="fnameNew" name="fname" type="text" class="form-control" placeholder="First name">
	            </div>
	            <div class="form-group col-md-6">
	                <input id="lnameNew" name="lname" type="text" class="form-control" placeholder="Last name">
	            </div>
	            </div>
	            <div class="form-group">
	                <label for="inputEmail4">Email</label>
	                <input id="emailNew" name="email" type="email" class="form-control" id="inputEmail4" placeholder="Email">
	            </div>
	            <div class="form-group">
	                <div class="form-check form-check-inline">
	                  <input class="form-check-input" type="radio" name="gender" id="maleNew" value="Male">
	                  <label class="form-check-label" for="male">Male</label>
	                </div>
	                <div class="form-check form-check-inline">
	                  <input class="form-check-input" type="radio" name="gender" id="femaleNew" value="Female">
	                  <label class="form-check-label" for="female">Female</label>
	                </div>
	                <div class="form-check form-check-inline">
	                  <input class="form-check-input" type="radio" name="gender" id="otherNew" value="Others">
	                  <label class="form-check-label" for="other">Others</label>
	                </div>
	            </div>
	            <div class="form-group">
	                <div class="form-check form-check-inline">
	                  <input class="form-check-input newHobby" type="checkbox" id="travellingNew" value="Travelling">
	                  <label class="form-check-label" for="travelling">Travelling</label>
	                </div>
	                <div class="form-check form-check-inline">
	                  <input class="form-check-input newHobby" type="checkbox" id="readingNew" value="Reading">
	                  <label class="form-check-label" for="reading">Reading</label>
	                </div>
	                <div class="form-check form-check-inline">
	                  <input class="form-check-input newHobby" type="checkbox" id="swimmingNew" value="Swimming">
	                  <label class="form-check-label" for="swimming">Swimming</label>
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="inputAddress">Address</label>
	                <input name="address" type="text" class="form-control" id="inputAddressNew" placeholder="1234 Main St">
	            </div>
	            <div class="custom-file">
		            <input type="file" class="custom-file-input" name="image" id="imageNew" onchange="readURL(this,'#editImage')">
		            <label class="custom-file-label" for="image">Choose file</label>
		            <img id="editImage" src="" alt="your image">
	            </div>
				<div>
					<input type="text" hidden id="created_By" name="created_By">
				</div>
				<div>
					<input type="text" hidden name="edited_By" value="{{ auth()->user()->email }}">
				</div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button onclick="closeEdit()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button id="submitButtonEdit" type="submit" class="btn btn-primary" onclick="editUserData()">Update</button>
	      </div>
	    </div>
	  </div>
	</div>