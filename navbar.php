<nav class="navbar sticky-top navbar-expand-lg flex-md-nowrap px-2 mb-1 border-bottom shadow bg-light-subtle fs-5 ">
    <div class="me-auto ms-3">
        <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="#" role="button" data-bs-toggle="dropdown">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16"><path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/><path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/></svg>
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
        </ul>
    </div>    

    
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }    
    if($_SESSION['privilegi']==1 /*studente*/){
        echo <<<NAVBAR
                <div class="collapse navbar-collapse me-auto ms-3" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/progettoquiz">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="tests.php">Tutti i test</a>
                    </li>
                </ul>
                </div>
                <span class="justify-content-end">studente</span>
        NAVBAR;
    }else if($_SESSION['privilegi']==2 /*docente*/){
        echo <<<NAVBAR
                <div class="collapse navbar-collapse me-auto ms-3" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/progettoquiz">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="my_tests.php">I miei test</a>
                    </li>
                </ul>
                </div>
                <span class="justify-content-end">docente</span>
        NAVBAR;
    }else if($_SESSION['privilegi']==3 /*admin*/){
        echo <<<NAVBAR
                <div class="collapse navbar-collapse me-auto ms-3" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/progettoquiz">Home</a>
                    </li>
                </ul>
                </div>
                <span class="justify-content-end">admin</span>
        NAVBAR;
    }

        
    /* <?php require("./navbar.php"); ?> */

    ?>
    <button class="navbar-toggler mx-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>