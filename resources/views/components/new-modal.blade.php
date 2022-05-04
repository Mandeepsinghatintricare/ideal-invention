	<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Enter Your Details</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form id="newDataForm" action="" method="POST" enctype="multipart/form-data">
	        @csrf
	          <div class="form-row">
	            <div class="form-group col-md-6">
	                <input id="fname" name="fname" type="text" class="form-control" placeholder="First name">
	            </div>
	            <div class="form-group col-md-6">
	                <input id="lname" name="lname" type="text" class="form-control" placeholder="Last name">
	            </div>
	            </div>
	            <div class="form-group">
	                <label for="inputEmail4">Email</label>
	                <input id="email" name="email" type="email" class="form-control" id="inputEmail4" placeholder="Email">
	            </div>
	            <div class="form-group">
	                <div class="form-check form-check-inline">
	                  <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
	                  <label class="form-check-label" for="male">Male</label>
	                </div>
	                <div class="form-check form-check-inline">
	                  <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
	                  <label class="form-check-label" for="female">Female</label>
	                </div>
	                <div class="form-check form-check-inline">
	                  <input class="form-check-input" type="radio" name="gender" id="other" value="Others">
	                  <label class="form-check-label" for="other">Others</label>
	                </div>
	            </div>
	            <div class="form-group">
	                <div class="form-check form-check-inline">
	                  <input class="form-check-input" type="checkbox" name="hobby[]" id="hobby1" value="Travelling">
	                  <label class="form-check-label" for="hobby1">Travelling</label>
	                </div>
	                <div class="form-check form-check-inline">
	                  <input class="form-check-input" type="checkbox" name="hobby[]" id="hobby2" value="Reading">
	                  <label class="form-check-label" for="hobby2">Reading</label>
	                </div>
	                <div class="form-check form-check-inline">
	                  <input class="form-check-input" type="checkbox" name="hobby[]" id="hobby3" value="Swimming">
	                  <label class="form-check-label" for="hobby3">Swimming</label>
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="inputAddress">Address</label>
	                <input name="address" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
	            </div>
	            <div class="custom-file">
	              <input type="file" class="custom-file-input" name="image" id="image" onchange="readURL(this,'#newImage')">
	              <label class="custom-file-label" for="image">Choose file</label>
	              <img id="newImage" src="" alt="your image">
	            </div>
				<div>
					<input type="text" hidden name="created_By" value="{{ auth()->user()->email }}">
				</div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button id="submitButtonNew" type="submit" class="btn btn-primary" onclick="newUserData()">Add User</button>
	      </div>
	    </div>
	  </div>
	</div>