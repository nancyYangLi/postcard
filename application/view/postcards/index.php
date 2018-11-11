<div class="container">

    <div id="div_postcards" class="postcards">
        -- images will be loaded here in js
    </div>

    <script language="JavaScript">
        $(document).ready(function() {
            placeImage();
            $('.postcards').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                centerMode: true,
                variableWidth: true,
                autoplay: true,
                autoplaySpeed: 2000,
            });
        });

        function placeImage() {
            var div = document.getElementById("div_postcards");
            var names = document.getElementById("card_names").value;
            var images;

            div.innerHTML = ""; // clear images
            images = names.split(',');            
            for (i=0; i<images.length; i++) {
                var imagem=document.createElement("img");
                imagem.src = 'https://localhost/postcard/postcards/rawImage?image=' + images[i];
                //imagem.width = 336;
                //imagem.height = 240;
                div.appendChild(imagem);
            }
        }
    </script>
</div>
