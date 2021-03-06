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
		<form>
    		<div class="form-group">
            	<label><i class="fa fa-user" aria-hidden="true"></i> Name</label>
            	<input id = "emailName" type="text" name="name" class="form-control" placeholder="Enter Name">
            </div>
            
            <div class="form-group">
            	<label><i class="fa fa-envelope" aria-hidden="true"></i> Email</label>
            	<input id = "emailTo" type="email" name="email" class="form-control" placeholder="Enter Email" required>
            </div>
            
            <div class="form-group">
            	<label><i class="fa fa-comment" aria-hidden="true"></i> Message</label>
            	<textarea id = "emailMsg" rows="3" name="message" class="form-control" placeholder="Type Your Message"></textarea>
            </div>
		</form>
		<div class="form-group">
            	<button id="sendEmail" class="btn btn-success btn-send">Send Your Postcard</button>
        </div>
	</div>
</div>
<div id="loader" style="display:none;" ></div>

<script language="JavaScript">
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var message = "your message...";
    var fillOrStroke ="fill";
    var request = new XMLHttpRequest();
    var dataURL;
	
    request.open('POST', document.location.origin + '/postcard/process/loadImage', true);
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
    
    // Embedding an image into a canvas
    function loadCanvas() {
        var img = new Image(); //Create new img element
        img.src = dataURL; 
        img.onload = function() {
          context.drawImage(img, 0, 0);
          drawScreen();
        };
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

    // Send an email containing the modified image as an attachment
	document.getElementById("sendEmail").addEventListener("click", function(e) {
		var loader = document.getElementById("loader");
 		var canvas = document.getElementById("canvas");
        var imageURL = canvas.toDataURL(); /* base64 */
        var name = document.getElementById("emailName").value;
        var to = document.getElementById("emailTo").value;
        var msg = document.getElementById("emailMsg").value;

        if ($('#emailTo')[0].checkValidity()) {
        	var data = {
            		imgBase64: imageURL, 
            		emailName: name,
            		emailTo: to,
            		emailMsg: msg
                };

                $.ajax({
                    url: '/postcard/process/sendemail',
                    type: 'POST',
                    data: data,
                    beforeSend: function(){
                    	loader.style.display = "block";
                    },
                    success: function( response ) {
                    	loader.style.display = "none";
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
        }
        else {
        	window.alert('Enter the email address!');
        }
    });
</script>

