<?php 
    $title = "Ajouter un film";
    $description = "Liste des films";
    $keywords = "Ajouter, nouveau, liste, films";
?>
<?php require __DIR__ . "/../partials/head.php"; ?>

    <?php require __DIR__ . "/../partials/nav.php"; ?>

    <!-- Le contenu spécifique a cette page -->
    <main class="container-fluid">
        <h1 class="my-3 display-5 text-center">Nouveau film</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-5 mx-auto p-4 rounded shadow bg-white">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="title">Titre du film <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control mt-2" autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="actors">Nom du/des acteurs <span class="text-danger">*</span></label>
                            <input type="text" name="actors" id="actors" class="form-control mt-2">
                        </div>

                        <div class="mb-3">
                            <label for="review">Note /5</label>
                            <input type="number" min="0" max="5" step=".5" name="review" id="review" class="form-control mt-2">
                        </div>

                        <div class="mb-3">
                            <label for="comment">Note /5</label>
                            <textarea name="comment" id="comment" class="form-control" rows="4"></textarea>
                        </div>

                        <div>
                            <input type="submit" class="btn btn-success" value="Envoyer">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    
    <?php require __DIR__ . "/../partials/footer.php"; ?>

<?php require __DIR__ . "/../partials/scripts_foot.php"; ?>

</html>