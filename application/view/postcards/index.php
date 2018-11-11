<div class="container">

    <div id="div_postcards" class="postcards">
       
    </div>

    <script language="JavaScript">
        $(document).ready(function() {
            placeImage();
            $('.postcards').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                //centerMode: true,
                variableWidth: true,
                autoplay: true,
                autoplaySpeed: 1500,
                prevArrow: false,
                nextArrow: false
            });
        });

        function placeImage() {
            var div = document.getElementById("div_postcards");
            var names = document.getElementById("card_names").value;
            var images;

            if (names != '') {
            	div.innerHTML = ""; // clear images
                images = names.split(',');            
                for (i=0; i<images.length; i++) {
                    var innerDiv = document.createElement("div");
                    var imagem=document.createElement("img");

                    imagem.src = 'https://localhost/postcard/postcards/rawImage?image=' + images[i];
                    innerDiv.appendChild(imagem);
                    div.appendChild(innerDiv);
                }
            }
            else {
            	var newContent = document.createTextNode("There is no postcard!");
            	div.parentNode.appendChild(newContent);
            	div.parentNode.removeChild(div);
            }
        }
    </script>
</div>
