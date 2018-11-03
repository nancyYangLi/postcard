<div class="container">
    <h2>You are in the View: application/view/home/example_one.php (everything in the box comes from this file)</h2>
    <p>In a real application this could be a normal page.</p>
    
    
        <div class="row">
            <div class="col-md-6">
                <div id="my_camera"></div>
                <br/>
                <video id="video" width="640" height="480" autoplay></video>
                <button id="snap">Snap Photo</button>
				<canvas id="canvas" width="640" height="480"></canvas>
            </div>
        </div>
    
    <!-- Configure a few settings and attach camera -->
    <script language="JavaScript">
    	var video = document.getElementById('video');

 		// Get access to the camera!
 		if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
     		// Not adding `{ audio: true }` since we only want video now
     		navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        		video.src = window.URL.createObjectURL(stream);
        		video.play();
     		});
 		}

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
