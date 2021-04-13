    <!-- Header avec class BS -->
    <?php include_once("./Commons/header.php"); ?>
    <title> Acceuil </title>

    <!-- Contenu du site-->
    <div class="border m-2 p-2 ">  

        <h1 class="text-center align-middle text-black"> Bienvue sur Sa&Ben.be</h1> 
                
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <!-- trait dans le bas caroussel (reprensete le nombre d'image) -->
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <!-- caroussel -->
            <div class="carousel-inner" style = "height : 400px;">
                <div class="carousel-item active"    >
                    <a href="blog.php">
                        <img src="../SRC/img/blog.jpg" class="d-block rounded img-fluid w-100 " alt="...">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="minichat.php">
                        <img src="../SRC/img/tchat.jpg" class="d-block rounded img-fluid w-100" alt="...">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="shop.php">
                        <img src="../SRC/img/shop.png" class="d-block rounded img-fluid w-100" alt="...">
                    </a>
                </div>
            </div>
            <!-- flèche droite caroussel -->
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <!-- flèche gauche caroussel -->
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div >

    <!-- Pied de page-->
    <?php include_once("./Commons/footer.php"); ?>


    

    
