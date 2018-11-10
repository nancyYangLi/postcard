<div class="container">

    <div id="div_postcards" class="postcards">
        <div>Postcards</div>
        <div>2</div>
    </div>

    <script language="JavaScript">
        var image_idx = [1541673435, 1541757222, 1541757358.];
        
        $(document).ready(function() {
            placeImage(image_idx);
            $('.postcards').slick();
        });

        function placeImage(idx) {
            var div = document.getElementById("div_postcards");

            div.innerHTML = ""; // clear images

            for (i=1; i<=idx.length; i++) {
                var imagem=document.createElement("img");
                imagem.src="images" + idx[i] + ".png";
                div.appendChild(imagem);
            }
        }
    </script>
</div>
