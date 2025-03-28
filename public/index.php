<?php 
session_start();

    $title = "Accueil";
    $description = "Liste des films";
    $keywords = "Accueil, liste, films";
    $fontAwesome = <<<HTML
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
HTML;
?>
<?php require __DIR__ . "/../partials/head.php"; ?>

    <?php require __DIR__ . "/../partials/nav.php"; ?>

    <!-- Le contenu spécifique a cette page -->
    <main>
        <h1 class="my-3 display-5 text-center">Liste des films</h1>

        <!-- Message flash de succes -->
         <?php if( isset($_SESSION['success']) && !empty($_SESSION['success'])) :?>
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <?= $_SESSION['success'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
            <?php unset($_SESSION['success']) ?>;
        <?php endif ?>


        <div class="container">
            <div class="d-flex justify-content-end align-items-center my-3">
                <a href="/create.php" class="btn btn-success shadow"><i class="fa-solid fa-plus"></i> Nouveau film</a>
            </div>
        </div>
    </main>
    
    <?php require __DIR__ . "/../partials/footer.php"; ?>

<?php require __DIR__ . "/../partials/scripts_foot.php"; ?>

</html>