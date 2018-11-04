<header role = "banner">
	<h2 class="headertekst">Welcome to the Postcard Creator!</h2>
</header>

<div class="container">
	<p>Please select your preferred postcard creator method:</p>
    <form action="home/source" method="post">
    	<div>
            <label>
            <input type="radio" name="imagesource" value="1" checked> Web Camera</label>
         </div>
        <div>
            <label>
            <input type="radio" name="imagesource" value="2"> File Upload</label>
        </div>
        <div>
            <label>
            <input type="radio" name="imagesource" value="3"> Drag and Drop</label>
        </div>
         <button type="submit" class="btn btn-success" name="submit">Submit</button>
     </form>   
</div>