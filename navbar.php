<nav class="navbar sticky-top navbar-expand-lg flex-md-nowrap px-2 py-3 mb-1 border-bottom shadow bg-light-subtle fs-5 ">
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
                    <a class="nav-link active" aria-current="page" href="tests.php">Tutti i test</a>
                </div>

                <span class="justify-content-end">studente</span>
                <span class="justify-content-end ms-3  d-flex align-items-center gap-1"> <a href="/progettoquiz"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                  </svg></a></span>

        NAVBAR;
    }else if($_SESSION['privilegi']==2 /*docente*/){
        echo <<<NAVBAR
                <div class="collapse navbar-collapse me-auto ms-3" id="navbarSupportedContent">
                    <a class="nav-link active" aria-current="page" href="#">I miei test</a>
                </div>
                <span class="justify-content-end">docente</span>
                <span class="justify-content-end ms-3  d-flex align-items-center gap-1"> <a href="/progettoquiz"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                  </svg> </a></span>
        NAVBAR;
    }else if($_SESSION['privilegi']==3 /*admin*/){
        echo <<<NAVBAR
                <div class="collapse navbar-collapse me-auto ms-3" id="navbarSupportedContent">
                    <a class="nav-link active" aria-current="page" href="#">I miei test</a>
                </div>
                <span class="justify-content-end">admin</span>
                <span class="justify-content-end ms-3"  d-flex align-items-center gap-1><a href="/progettoquiz"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                  </svg></a></span>
        NAVBAR;
    }

        
    /* <?php require("./navbar.php"); ?> */

    ?>
    <button class="navbar-toggler mx-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>