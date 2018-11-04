<div class="container">
	<div>
    	<p>1. Click the "Open Camera" button and take a Snapshot!</p>
    	<div class="row">
    		<div class="col-md-6">
                <br/>
                <video id="video" width="640" height="480" autoplay></video>
                <button id="showVideo"> Open Camera</button> 
                <button id="snap" style="display:none;">Snap Photo</button> 
                <div id="errorMsg"></div>
                <canvas id="canvas" width="640" height="480"></canvas>
            </div>
        </div>
	</div>

    <div class="box" style="display:none" id="msgbox" >
    	<p>2. Modify the image to contain a message</p>
    	<form>
  			Message: <input id="textBox" placeholder="your message"/>
  			Fill Or Stroke:
 				<select id = "fillOrStroke">
  					<option value = "fill">fill</option>
  					<option value = "stroke">stroke</option>
   					<option value = "both">both</option>
				</select>
		</form>
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
	     		document.querySelector('#errorMsg').innerHTML = e.name + ": " + e.message;
		    }
		}
 		document.querySelector('#showVideo').addEventListener('click', e => init(e));
		

 		// Elements for taking the snapshot
 		var canvas = document.getElementById('canvas');
 		var context = canvas.getContext('2d');
 		var msgbox = document.getElementById('msgbox');

 		// Trigger photo take
 		document.getElementById("snap").addEventListener("click", function() {
 			context.drawImage(video, 0, 0, 640, 480);
 			msgbox.style.display = "block";
 		});


		// Modify the image to contain a message
		
		
		var message = "your text";
   		var fillOrStroke ="fill";

   		var formElement = document.getElementById("textBox");
   	    formElement.addEventListener("keyup", textBoxChanged, false);
		
		
   	 	formElement = document.getElementById("fillOrStroke");
     	formElement.addEventListener("change", fillOrStrokeChanged, false);

     	drawScreen();

     	function drawScreen() {
 	      //Background
 	      context.fillStyle = "#ffffaa";
 	      context.fillRect(0, 0, canvas.width, canvas.height);
     	      
 	      //Box
 	      context.strokeStyle = "#000000";
 	     // context.strokeRect(5,  5, canvas.width−10, canvas.height−10);

 	      //Text
 	      context.font = "50px serif"

 	      var metrics = context.measureText(message);
 	      var textWidth = metrics.width;
 	      var xPosition = (canvas.width/2) - (textWidth/2);
 	      var yPosition = (canvas.height/2);

 	      switch(fillOrStroke) {
 	         case "fill":
 	            context.fillStyle = "#FF0000";
                context.fillText (message, xPosition,yPosition);
 	            break;
 	         case "stroke":
 	            context.strokeStyle = "#FF0000";
 	            context.strokeText (message, xPosition,yPosition);
 	            break;
 	         case "both":
 	            context.fillStyle = "#FF0000";
                context.fillText (message, xPosition ,yPosition);
 	            context.strokeStyle = "#000000";
 	            context.strokeText (message, xPosition,yPosition);
 	            break;
  			}		
 	   }

     	function textBoxChanged(e) {
 	      var target = e.target;
 	      message = target.value;
 	      drawScreen();
 	   }

 	   function fillOrStrokeChanged(e) {
 	      var target = e.target;
 	      fillOrStroke = target.value;
 	      drawScreen();
 	   }
    </script>
</div>
