<div class="container">
	<div>
    	<p>Click the button blow and take a snapshot!</p>
    	<div class="row">
    		<div class="col-md-6">
                <video id="video" width="672" height="480" autoplay></video>
                <button id="snap">Snapshot</button> 
                <div id="errorMsg"></div>
                <canvas id="canvas" width="672" height="480"></canvas>
                <button id="upload" style="display:none;">Use Photo</button> 
            </div>
        </div>
	</div>
   
    <!-- Configure a few settings and attach camera -->
    <script language="JavaScript">
 		// Get access to the camera
 		var video = document.getElementById('video');
 		
 		function opencamera() {
 	 		try {
 	 	 		navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
	        		//video.src = window.URL.createObjectURL(stream);
	        		video.srcObject = stream;
	        		video.play();
	     		})
	     	} catch (e) {
	     		document.querySelector('#errorMsg').innerHTML = e.name + ": " + e.message;
		    }
		}

		opencamera();
 		
		// Elements for taking the snapshot
 		var canvas = document.getElementById('canvas');
 		var context = canvas.getContext('2d');
 		var uploadbtn = document.getElementById("upload");

 		// Trigger photo take
 		document.getElementById("snap").addEventListener("click", function() {
 			context.drawImage(video, 0, 0, canvas.width, canvas.height);
 			uploadbtn.style.display = "block";
 		});

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
