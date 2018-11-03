<h2 class="headertekst">Welcome to the Postcard Creator!</h2>
<div class="container">
    
    <p>Please select an option to create you own postcard:</p>
    
    <form action="home/source" method="post">
        <div class="radio">
            <label>
            <input type="radio" name="imageinput" value="fileupload"> File Upload</label>
        </div>
        <div class="radio">
            <label>
            <input type="radio" name="imageinput" value="dragdrop"> Drag and Drop</label>
        </div>
        <div class="radio">
            <label>
            <input type="radio" name="imageinput" value="webcamera"> Web Camera</label>
         </div>
         <button type="submit" class="btn btn-success" name="submit">Submit</button>
     </form>   
</div>