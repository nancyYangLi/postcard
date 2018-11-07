<div class="container">
	<div>
		<form action="email/sendemail" method="post">
    		<div class="form-group">
            	<label><i class="fa fa-user" aria-hidden="true"></i> Name</label>
            	<input type="text" name="name" class="form-control" placeholder="Enter Name">
            </div>
            
            <div class="form-group">
            	<label><i class="fa fa-envelope" aria-hidden="true"></i> Email</label>
            	<input type="email" name="email" class="form-control" placeholder="Enter Email" required>
            </div>
            
            <div class="form-group">
            	<label><i class="fa fa-comment" aria-hidden="true"></i> Message</label>
            	<textarea rows="3" name="message" class="form-control" placeholder="Type Your Message"></textarea>
            </div>
            
            <div class="form-group">
            	<button id="sendimg" class="btn btn-raised btn-block btn-danger">Send Your Postcard</button>
            </div>
		</form>

    	<div id="error_message" style="width:100%; height:100%; display:none;">
    		<h4>Error</h4>
    		Sorry there was an error sending your form.
    	</div>
	</div>
</div>

<script language="JavaScript">
	

	


 	
</script>




<?php 



?>
