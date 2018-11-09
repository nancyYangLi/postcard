<div class="container">
	<div>
		<p>Add a message to the image</p>
		<canvas id="canvas" width="672" height="480"></canvas>
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
	
	<div class="box">
		<form action="" method="post">
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
            	<button id="sendEmail" type="submit" class="btn btn-success btn-send">Send Your Postcard</button>
            </div>
		</form>
	</div>
	
</div>

<script language="JavaScript">


    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var message = "your message...";
    var fillOrStroke ="fill";
    var request = new XMLHttpRequest();
    var dataURL;
	
    
    request.open('POST', 'https://localhost/postcard/process/loadImage', true);
    // Inform the server that the parameters are encoded in URL
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.onreadystatechange = function() {
        // Makes sure the document is ready to parse.
        if (request.readyState == 4) {
            // Makes sure it's found the file.
            if (request.status == 200) {
                dataURL = 'data:image/png;base64,' + request.responseText;
                loadCanvas();
            }
        }
    };
    request.send(encodeURI('image=current-snap.png'));
    
    // Load user's specific image to canvas
    function loadCanvas() {
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
        var yPosition = canvas.height-50;
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
        loadCanvas();
    }
    
    function fillOrStrokeChanged(e) {
        var target = e.target;
        fillOrStroke = target.value;
        loadCanvas();
    }

    // Upload image to server and go to email send page
	document.getElementById("sendEmail").addEventListener("click", function(e) {
 		var canvas = document.getElementById('canvas');
        var imageURL = canvas.toDataURL(); /* base64 */

        $.ajax({
            url: '/postcard/process/sendemail',
            type: 'POST',
            data: { imgBase64: imageURL, message: 'test teate test' },
            async: false,
            success: function( response ) {
            	if (response) {
                    var res = JSON.parse(response);
                    var msg;
                    if (res.success) {
                        msg = "Post card has been sent to your mailbox"
                    }
                    else {
                        msg = res.msg;
                    }
                    window.alert(msg);
                }
                else {
                    window.alert('Failed to upload image');
                }  
            }
        });     	
    });
</script>

