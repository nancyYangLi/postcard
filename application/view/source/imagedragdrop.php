<div class="container">
	<div>
		<p>Drag and drop an image file</p>
    	<div class="row">
    		<div class="col-md-6">
                <canvas id="canvas" width="672" height="480"></canvas>
                <button id="upload" style="display:none;">Use Photo</button> 
            </div>
        </div>
	</div>
	

	<!-- Configure a few settings -->	
	<script language="JavaScript">
	// Drag and drop images to canvas
	var canvas = document.getElementById('canvas');
	var context = canvas.getContext('2d');
	var uploadbtn = document.getElementById("upload");
	
	window.ondragover = function(e) {e.preventDefault()}
	window.ondrop = function(e) {e.preventDefault(); handleImage(e.dataTransfer.files[0]); }

	function handleImage(file){ 
	    var img =new Image();
	    // call context.drawImage when the image got loaded
	    img.onload = function() {
			context.drawImage(img, 0, 0, canvas.width, canvas.height);
			uploadbtn.style.display = "block";
		}
	 	// URL @ Mozilla, webkitURL @ Chrome
	   	img.src = URL.createObjectURL(file);
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