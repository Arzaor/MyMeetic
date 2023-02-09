<!doctype html>
<html lang="fr" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.108.0">
        <title><?= $title ?></title>
        <link href="templates/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="templates/css/bootstrap.min.css">
    </head>
    <body class="d-flex flex-column h-100">
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">MyMeetic</a>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link <?= (isset($_GET['action']) && $_GET['action'] === 'search') ? "active" : null; ?>" aria-current="page" href="index.php?action=search">Accueil</a>
                            <a class="nav-link <?= (isset($_GET['action']) && $_GET['action'] === 'messaging') ? "active" : null; ?>" href="index.php?action=messaging">Messages</a>
                            <a class="nav-link <?= (isset($_GET['action']) && $_GET['action'] === 'profil') ? "active" : null; ?>" href="index.php?action=profil">Profil</a>
                            <a class="nav-link" href="index.php?action=logout">Déconnexion</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main class="flex-shrink-0">
            <?= $content ?>
        </main>
        <footer class="footer mt-auto py-3 bg-light">
            <div class="container">
                <span class="text-muted">Place sticky footer content here.</span>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script src="templates/js/script.js"></script>
    </body>
</html>
