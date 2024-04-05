</head>
<body>
    <header>
        <div id="welcome">
            <span id="uname">Hi, <?php echo $_SESSION['name']; ?></span>
            <a href="logout.php"><img src="images/logout.svg" alt="LOGOUT" id="logout"></a>
        </div>
<?php
    $page_name = array ("","","Home","Add Contacts","Edit Contacts","All Contacts","View Contact","Settings",)
?>
        <h1>Contact Book <span id="pgname">- <?php echo $page_name[$page_id] ?> </span></h1>
    </header>
    <nav id="menu">
        <a href="index.php" class="menu">
            <img src="images/home-yellow.svg" alt="Home" class="menuImg">
            <span class="menuText">Home</span>
        </a>
        <a href="add.php" class="menu">
            <img src="images/add-yellow.svg" alt="Add" class="menuImg">
            <span class="menuText" <?php if ($page_id == 3) echo 'id="active"' ?> >Add New</span>
        </a>
        <a href="all.php" class="menu">
            <img src="images/search-yellow.svg" alt="Search" class="menuImg">
            <span class="menuText" <?php if ($page_id == 5) echo 'id="active"' ?> >Show All</span>
        </a>
        <a href="settings.php" class="menu">
            <img src="images/settings-yellow.svg" alt="Settings" class="menuImg">
            <span class="menuText" <?php if ($page_id == 7) echo 'id="active"' ?> >Settings</span>
        </a>
        <a href="logout.php" class="menu">
            <img src="images/logout-yellow.svg" alt="LOGOUT" class="menuImg">
            <span class="menuText">Logout</span>
        </a>
    </nav>
    <main>