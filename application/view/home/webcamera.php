<div class="container">
	<p>Take a picture with your camera!</p>
	<div class="row">
		<div class="col-md-6">
			<div id="my_camera"></div>
            <br/>
            <video id="video" width="640" height="480" autoplay></video>
            <button id="showVideo"> Open Camera</button>
            <button id="snap" style="display:none;">Snap Photo</button>    
			<canvas id="canvas" width="640" height="480"></canvas>
        </div>
    </div>
    
    <!-- Configure a few settings and attach camera -->
    <script language="JavaScript">
 		var video = document.getElementById('video');
 		var snapbtn = document.getElementById('snap');

 		// Get access to the camera
 		function init(e) {
 	 		try {
 	 	 		navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
	        		video.src = window.URL.createObjectURL(stream);
	        		video.play();
	     		})
	     		e.target.style.display = "none";
	     		snapbtn.style.display = "block";
	     	} catch (e) {
	     		console.log(e.name + ": " + e.message);
		    }
		}

 		document.querySelector('#showVideo').addEventListener('click', e => init(e));
		

 		// Elements for taking the snapshot
 		var canvas = document.getElementById('canvas');
 		var context = canvas.getContext('2d');
 		var video = document.getElementById('video');

 		// Trigger photo take
 		document.getElementById("snap").addEventListener("click", function() {
 			context.drawImage(video, 0, 0, 640, 480);
 		});
    </script>
</div>
