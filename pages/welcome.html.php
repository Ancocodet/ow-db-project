<?php
$params = $_GET['params'] ?? [];
$pageName = 'Welcome';
?>
<html lang="en">
<head>
    <title>OW-DB | <?php echo $pageName; ?></title>
    <link type="text/css" rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <script src="../dist/js/bootstrap.bundle.min.js"></script>

    <link rel="icon" href="../dist/images/favicon.ico">
</head>
<body class="bg-light w-100 h-100">
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="/welcome" class="nav-link px-2 text-secondary">Home</a></li>
                    <li><a href="/heroes" class="nav-link px-2 text-white">Heroes</a></li>
                    <li><a href="/games" class="nav-link px-2 text-white">Games</a></li>
                    <li><a href="/maps" class="nav-link px-2 text-white">Maps</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link px-2 text-white" href="#" id="others_dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Others
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="others_dropdown">
                            <li><a class="dropdown-item" href="/others/maps">Maps</a></li>
                            <li><a class="dropdown-item" href="/others/gamemodes">GameModes</a></li>
                        </ul>
                    </li>
                    <li><a href="https://github.com/Ancocodet/ow-db-project" class="nav-link px-2 text-white">Repository</a></li>
                </ul>
            </div>
        </div>
    </header>
    <main>
        <div class="container mt-5 mx-auto">
            <h2>Database Model</h2>
            <img alt="Database Model" src="dist/images/diagram-var-trans.png">
        </div>
    </main>
</body>
</html>