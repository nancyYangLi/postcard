<div class="container">
	<div>
		<p>Choose an image file to upload</p>
		
		<div class="row">
    		<div class="col-md-6">
                <input type="file" id="fileinput" accept="image/*">
                <canvas id="canvas" width="500" height="500"></canvas>
                <button id="upload">Use Photo</button> 
            </div>
        </div>
	</div>
	
	
	<!-- Configure a few settings -->
	<script language="JavaScript">
	// Load the uploaded image to canvas
	var uploadfiles = document.querySelector('#fileinput');
	var canvas = document.getElementById('canvas');
	var context = canvas.getContext('2d');
	
	uploadfiles.addEventListener('change', handleImage, false);

	function handleImage(e){
	    var reader = new FileReader();
	    reader.onload = function(event){
	        var img = new Image();
	        img.onload = function(){
	            context.drawImage(img,0,0,canvas.width, canvas.height);
	        }
	        img.src = event.target.result;
	    }
	    reader.readAsDataURL(e.target.files[0]);     
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
                    /* todo: add pop-up dialog to show error */
                    console.log('Failed to upload image' + response);
                }
            }
        }); 	
    });
	</script>
</div>
