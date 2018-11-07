<div class="container">
	<div>
		<p>Add a message to the image</p>
		<canvas id="canvas" width="500" height="400"></canvas>
		<form>
            Message: <input id="msgBox" placeholder="your message"/>
            <br/>
            Fill Or Stroke:
            <select id = "fillOrStroke">
            <option value = "fill">fill</option>
            <option value = "stroke">stroke</option>
            <option value = "both">both</option>
            </select>
        </form>
	</div>
	
</div>

<script language="JavaScript">
	var dataURL = "https://www.gstatic.com/webp/gallery/1.jpg";
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var message = "your message...";
    var fillOrStroke ="fill";

	// Load user's specific image to canvas
	loadCanvas(dataURL);
    function loadCanvas(dataURL) {
        var img = new Image();
        img.onload = function() {
          context.drawImage(img, 0, 0);
          drawScreen();
        };
        img.src = dataURL;
    }

	// Add message to canvas
    function drawScreen() {
    	var xPosition = 50;
        var yPosition = canvas.height-100;
        var maxWidth = canvas.width-xPosition*2;
        
        context.font = "30px serif";
        
        switch(fillOrStroke) {
            case "fill":
            	context.fillStyle = "#005ce6";
                context.fillText (message, xPosition,yPosition, maxWidth);
                break;
            case "stroke":
            	context.strokeStyle = "#e65c00";
                context.strokeText (message, xPosition,yPosition, maxWidth);
                break;
            case "both":
            	context.fillStyle = "#005ce6";
                context.fillText (message, xPosition ,yPosition, maxWidth);
                context.strokeStyle = "#e65c00";
                context.strokeText (message, xPosition,yPosition, maxWidth);
                break;
        }
    }

    var formElement = document.getElementById("msgBox");
    formElement.addEventListener("keyup", textBoxChanged, false);
    
    formElement = document.getElementById("fillOrStroke");
    formElement.addEventListener("change", fillOrStrokeChanged, false);
        
    function textBoxChanged(e) {
        var target = e.target;
        message = target.value;
        loadCanvas(dataURL);
    }
    
    function fillOrStrokeChanged(e) {
        var target = e.target;
        fillOrStroke = target.value;
        loadCanvas(dataURL);
    }
</script>




<?php 
// old code

/*

<div style="display:none" id="processbox">
<div class="box">
<p>2. Modify the image to contain a message</p>
<form>
Message: <input id="textBox" placeholder="your message"/>
<br/>
Fill Or Stroke:
<select id = "fillOrStroke">
<option value = "fill">fill</option>
<option value = "stroke">stroke</option>
<option value = "both">both</option>
</select>
</form>
</div>


<div class="box">
<p>3. Send it as an email to a specified recipient</p>

<form action="<?php echo URL; ?>webcamera/updateImage" method="POST">
<form action="/exampleTwo" method="post">
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
<textarea id="imageData" name="imageData" rows=10 cols=30 style="display:none"></textarea>
</form>

<div id="error_message" style="width:100%; height:100%; display:none;">
<h4>Error</h4>
Sorry there was an error sending your form.
</div>
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
            //video.src = window.URL.createObjectURL(stream);
            video.srcObject = stream;
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
    canvas.style.display = "block";
    context.drawImage(video, 0, 0, 640, 480);
    processbox.style.display = "block";
});
    
    
    // Modify the image to contain a message
    var message = "your message...";
    var fillOrStroke ="fill";
    
    var formElement = document.getElementById("textBox");
    formElement.addEventListener("keyup", textBoxChanged, false);
    
    
    formElement = document.getElementById("fillOrStroke");
    formElement.addEventListener("change", fillOrStrokeChanged, false);
    
    drawScreen();
    
    function drawScreen() {
        var xPosition = 50;
        var yPosition = canvas.height-50;
        var maxWidth = canvas.width-xPosition*2;
        
        //Background
        context.fillStyle = "#ffffff";
        context.fillRect(0, 480, canvas.width, 50);
        
        //Box
        context.strokeStyle = "#OOOOFF";
        
        //Text
        context.font = "30px serif";
        
        switch(fillOrStroke) {
            case "fill":
                context.fillStyle = "#8ED6FF";
                context.fillText (message, xPosition,yPosition, maxWidth);
                break;
            case "stroke":
                context.strokeStyle = "#OOOOFF";
                context.strokeText (message, xPosition,yPosition, maxWidth);
                break;
            case "both":
                context.fillStyle = "##8ED6FF";
                context.fillText (message, xPosition ,yPosition, maxWidth);
                context.strokeStyle = "#0000FF";
                context.strokeText (message, xPosition,yPosition, maxWidth);
                break;
        }
    }
    
    function textBoxChanged(e) {
        var target = e.target;
        message = target.value;
        drawScreen();
        
        updateImageData();
    }
    
    function fillOrStrokeChanged(e) {
        var target = e.target;
        fillOrStroke = target.value;
        drawScreen();
        
        upateImageData();
    }
    
    function updateImageData() {
        var imageData = document.getElementById('imageData');
        imageData.value = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
        // here is the most important part because if you dont replace you will get a DOM 18 exception.
    }
    
    </script>
    </div>
    
*/

?>
