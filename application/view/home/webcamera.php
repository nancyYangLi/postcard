<div class="container">
	<div>
    	<p>Click the button blow and take a snapshot!</p>
    	<div class="row">
    		<div class="col-md-6">
                <video id="video" width="640" height="480" autoplay></video>
                <button id="snap">Snap Photo</button> 
                <div id="errorMsg"></div>
                <canvas id="canvas" width="640" height="480"></canvas>
            </div>
        </div>
	</div>

	<div>
		<br/>
    	<ul class="pagination">
        	<li class="page-item"><a class="page-link" href="<?php echo URL?>">Previous</a></li>
        	<li class="page-item"><a class="page-link" href="<?php echo URL;?>home/imageprocess">Next</a></li>
  		</ul>
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

 		// Trigger photo take
 		document.getElementById("snap").addEventListener("click", function() {
 			context.drawImage(video, 0, 0, 640, 480);
 		});
 	   
    </script>
</div>
