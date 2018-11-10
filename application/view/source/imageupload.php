<div class="container">
	<div>
		<p>Choose an image file to upload</p>
		<div class="row">
    		<div class="col-md-6">
                <input type="file" id="fileinput" accept="image/*">
                <canvas id="canvas" width="672" height="480"></canvas>
                <button id="upload" style="display:none;">Use Photo</button> 
            </div>
        </div>
	</div>
	
	
	<!-- Configure a few settings -->
	<script language="JavaScript">
	// Preview the image
	var uploadfiles = document.querySelector('#fileinput');
	var canvas = document.getElementById('canvas');
	var context = canvas.getContext('2d');
	var uploadbtn = document.getElementById("upload");
	
	uploadfiles.addEventListener('change', handleImage, false);

	function handleImage(e){
		// Using FileReader to display the image content
	    var reader = new FileReader();
	    reader.onload = function(event){
	        var img = new Image();
	        img.onload = function(){
	            context.drawImage(img,0,0,canvas.width, canvas.height);
	        }
	        img.src = event.target.result;
	    }
	    reader.readAsDataURL(e.target.files[0]);  
	    uploadbtn.style.display = "block";
	}

	// Upload the image to server
	document.getElementById("upload").addEventListener("click", function() {
		var imageURL = canvas.toDataURL(); /* base64 */
        
        $.ajax({
            url: '/postcard/source/upload',
            type: 'POST',
            data: { imgBase64: imageURL },
            success: function( response ) {
                if (response) 
                    window.location="https://localhost/postcard/process";
                else {
                	window.alert('Failed to upload image to edit');
                }
            }
        }); 	
    });
	</script>
</div>
