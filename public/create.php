<?php
session_start();

    require __DIR__ . "/../functions/security.php";
    require __DIR__ . "/../functions/helper.php";

    // Si les données du formulaire sont envoyées via la methode POST
    if( $_SERVER['REQUEST_METHOD'] === "POST" )
    {

        /** 
         * ***********************************************
         * Traitement des données du formulaire
         * **********************************************
        */

        // 1 - Protéger le serveur contre les failles de type csrf

        // Si la clé 'csrf_token' qui se trouve dans le tableau $_post n'existe pas, fin script
        if( ! array_key_exists('csrf_token', $_POST) )
        {
            // Rediriger l'utilisateur vers la page de laquelle proviennent les informations
            // puis, arrêter l'éxécution
            return header("Location: create.php");
        }

        if( ! isCsrfTokenValid($_SESSION['csrf_token'], $_POST['csrf_token']) )
        {
            // Rediriger l'utilisateur vers la page de laquelle proviennent les informations
            // puis, arrêter l'éxécution
            return header("Location: create.php");
        }

        // 2 - Protéger le serveur contre les robots spam

        // Si la clé 'honey_pot' qui se trouve dans le tableau $_post n'existe pas, fin script
        if( ! array_key_exists('honey_pot', $_POST) )
        {
            // Rediriger l'utilisateur vers la page de laquelle proviennent les informations
            // puis, arrêter l'éxécution
            return header("Location: create.php");
        }

        if ( isHoneyPotLicked($_POST['honey_pot']) )
        {
            // Rediriger l'utilisateur vers la page de laquelle proviennent les informations
            // puis, arrêter l'éxécution
            return header("Location: create.php");       
        }

        // 3 - Définir les contraintes de validations du formulaire
        $formErrors = [];

        if ( isset($_POST['title']) )
        {
            if( trim($_POST['title']) === "")
            {
                $formErrors['title'] = "Le titre du film est obligatoire.";
            }

            if( mb_strlen($_POST['title']) > 255 )
            {
                $formErrors['title'] = "Le titre du film ne doit pas dépasser 255 caractères.";
            }
        }

        if ( isset($_POST['actors']) )
        {
            if( trim($_POST['actors']) === "")
            {
                $formErrors['actors'] = "Le nom du/des acteurs du film est obligatoire.";
            }

            if( mb_strlen($_POST['actors']) > 255 )
            {
                $formErrors['actors'] = "Le nom du/des acteurs du film ne doit pas dépasser 255 caractères.";
            }
        }

        if ( isset($_POST['review']) )
        {
            if( trim($_POST['review']) !== "")
            {
                if( !is_numeric($_POST['review']) )
                {
                    $formErrors['review'] = "La note du film doit être un nombre.";
                }

                if( $_POST['review'] < 0 || $_POST['review'] > 5 )
                {
                    $formErrors['review'] = "La note doit être comprise entre 0 et 5.";
                }
            }
        }

        if ( isset($_POST['comment']) )
        {
            if( trim($_POST['comment']) !== "")
            {
                if( mb_strlen($_POST['comment']) > 500 )
                {
                    $formErrors['comment'] = "Le commentaire ne doit pas dépasser 500 caractères.";
                }
            }
        }

        // 4 - Si le formulaire est invalide
        if ( count($formErrors) > 0 )
        {
            // Sauvegardons les messages d'erreur en session
            $_SESSION['formErrors'] = $formErrors;

            // Sauvegardons les anciennes données du formulaire en session
            $_SESSION['old'] = $_POST;

            // Rediriger l'utilisateur vers la page de laquelle proviennent les informations
            // puis, arrêter l'éxécution
            return header("Location: create.php");
        }

        dd('legggooooo');
        
        // Dans le cas contraire (else)
        // 5 - Arrondir la note à un chiffre après la virgule

        // 6 - Etablir une connexion avec la BDD

        // 7 - Effectuer la requête d'insertion du nouveau film dans la table film

        // 8 - Générer le message flash de succès

        // 9 - Effectuer une redirection vers la page d'accueil
        // puis, arrêter l'éxécution du script.
    }

    // Générer le jeton de sécurité (csrf_token)
    $_SESSION['csrf_token'] = bin2hex(random_bytes(10));
?>

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


                    <!-- Pour les messages d'erreurs -->
                    <?php if( isset($_SESSION['formErrors']) && !empty($_SESSION['formErrors']) ) : ?>
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                <?php foreach($_SESSION['formErrors'] as $error) : ?>
                                    <li> <?= $error ?> </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <?php unset($_SESSION['formErrors']); ?>
                    <?php endif ?>
                    


                    <form method="post">
                        <div class="mb-3">
                            <label for="title">Titre du film <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control mt-2" autofocus value="<?= old($_SESSION['old'], 'title'); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="actors">Nom du/des acteurs <span class="text-danger">*</span></label>
                            <input type="text" name="actors" id="actors" class="form-control mt-2" value="<?= old($_SESSION['old'], 'actors'); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="review">Note /5</label>
                            <input type="number" min="0" max="5" step=".5" name="review" id="review" class="form-control mt-2" value="<?= old($_SESSION['old'], 'review'); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="comment">Laisser un commentaire</label>
                            <textarea name="comment" id="comment" class="form-control" rows="4"><?= old($_SESSION['old'], 'comment'); ?></textarea>
                        </div>

                        <!-- csrf_token -->
                        <div>
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        </div>

                        <!-- honey_pot -->
                         <div>
                            <input type="hidden" name="honey_pot" value="">
                         </div>

                        <div>
                            <input formnovalidate type="submit" class="btn btn-success" value="Envoyer">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    
    <?php require __DIR__ . "/../partials/footer.php"; ?>

<?php require __DIR__ . "/../partials/scripts_foot.php"; ?>

</html>