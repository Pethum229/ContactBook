<?php
$page_id =5;
include_once "inc_header.php";
?>
    <title>Show All Contacts</title>
    <style>
        ul{
            list-style: none;
            display: table;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        li{
            display: table-cell;
            padding: 5px .5%;
            width: 11%;
            border-right: 1px solid #ccc;
            font-family: 'Open Sans', sans-serif;
            overflow: hidden; /*No changes*/
        }
        #row{
            background: #444;
            color: #fff;
        }
        .male , .view , .edit , .delete, .female{
            width: 20px;
            height: 20px;
            background-size: cover;
            display: inline-block;
            margin: 0 2px;
        }
        .male{
            background-image: url("images/male.svg");
        }
        .female{
            background-image: url("images/female.svg");
        }
        .view{
            background-image: url("images/view.svg");
            background-size: contain;
            background-repeat: no-repeat;
        }
        .edit{
            background-image: url("images/edit.svg");
        }
        .delete{
            background-image: url("images/delete.svg");
        }        
        .col1{
            width: 3%;
        }
        .col2{
            width: 23%;
        }
        .col3{
            border-right: 0;
            text-align: center;
        }
        .row2{
            background: #eee;
        }

        /* Style of Pagination */
        .pg{
            background: #f3b918;
            color: #000;
            box-shadow: 0 0 3px #000;
        }
        .pg:hover{
            background: #f27609;
        }
        .pg , .dots , .current{
            padding: 5px;
            text-decoration: none;
            margin: 5px;
            float: left;
            font-size: 1em;
        }
        .current{
            background: #333;
            color: #fff;
            box-shadow: 0 0 3px #000;
        }
        #pagination{
            margin-top: 20px;
        }

        /* Styles of search bar */

        form{
            margin-bottom: 20px;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            border-bottom: 3px solid #444;
            padding-bottom: 10px;
        }
        .in1{
            width: 250px;
            background: #ebe5e5;
            padding: 5px;
            border: 1px solid #ccc;
            font-family: 'Open Sans', sans-serif;
        }
        .in2{
            background: #f3b918;
            color: #000;
            width: 120px;
            margin: 0 5px;
            padding: 5px 0;
            border: 0;
            box-shadow: 0 0 3px #000;
            font-family: 'Open Sans', sans-serif;
            font-size: 1.1em;
        }
        .gender{
            background: #ebe5e5;
            padding: 8px;
            float: left;
            margin: 0 2px;
        }
        .in2:hover{
            background: #f27609;
        }
        select{
            font-family: 'Open Sans', sans-serif;
            font-size: 1.1em;
            padding: 2px 0;
        }
        .searchError{
            background: red;
            padding: 10px 5px;
            box-sizing: border-box;
            width:100%;
        }

        /* Media Quaries */

        /* Media Quaries for menu */
        @media screen and (max-width:1220px) {
            #menu{
                width: 100%;
            }
            .menu{
                float: left;
                border-bottom: 0;
                border-right: 1px dashed #f3b918;
                margin: 10px 0;
                padding: 0;
                width: 19%;
                text-align: center;
            }
            .menu:last-child{  /*.menu:last-child or #menu:last-child*/
                border-right: 0;
            }

            /* Search Form */
            .item{
                width: 30%;
                margin-bottom: 15px;
            }
            select{
                width: 100%;
            }
            .in1{
                width: 95%;
                padding: 5px 2%;
            }
            .in2{
                width: 100%;
                margin: 0;
            }
            .gender{
                width: 41%;
                padding: 8px 4%;
                margin: 0 .5%;
            }
        }

        /* Contact Table */
        @media screen and (max-width:880px) {
            #row{
                display: none;
            }
            ul{
                display: flex;
                flex-wrap: wrap;
            }
            li{
                display: block;
                padding: 5px 0;
                width: 24%;
                text-indent: 5px;
                border-bottom: 1px solid #ccc;
            }
            .col1, .col2{
                width: 24%;
            }
            .col3{
                text-align: left;
            }
            li:nth-child(4){
                border-right: 0;
            }
        }

        @media screen and (max-width:745px) {
            .item{
                width: 48%;
            }
        }

        @media screen and (max-width:600px) {
            li, .col1, .col2{
                width: 48%;
            }
            li:nth-of-type(2n){
                border-right: 0;
            }
        }

        @media screen and (max-width:485px) {
            .item{
                width: 95%;
            }
        }

        @media screen and (max-width:400px) {
            li, .col1, .col2{
                width: 99%;
                border-right: 0;
            }
        }

        @media screen and (max-width:320px) {
            #menu{
                width: 320px;
            }
        }

    </style>
    <?php include_once "inc_menus.php" ?>
        <form>
            <div class="item">
                <select name="rows">
                    <option value="0" <?php if(isset($_GET['rows']) && $_GET['rows']== 0) echo "selected"; ?> >Show 5 rows</option>
                    <option value="1" <?php if(isset($_GET['rows']) && $_GET['rows']== 1) echo "selected"; ?> >Show 10 rows</option>
                    <option value="2" <?php if(!isset($_GET['rows']) || $_GET['rows']== 2) echo "selected"; ?> >Show 15 rows</option>
                    <option value="3" <?php if(isset($_GET['rows']) && $_GET['rows']== 3) echo "selected"; ?> >Show 20 rows</option>
                    <option value="4" <?php if(isset($_GET['rows']) && $_GET['rows']== 4) echo "selected"; ?> >Show 25 rows</option>
                    <option value="5" <?php if(isset($_GET['rows']) && $_GET['rows']== 5) echo "selected"; ?> >Show 50 rows</option>
                    <option value="6" <?php if(isset($_GET['rows']) && $_GET['rows']== 6) echo "selected"; ?> >Show 100 rows</option>
                </select>
            </div>
            <div class="item">
                <select name="char">
                    <option value="0" <?php if(!isset($_GET['char']) || $_GET['char']== 0) echo "selected"; ?> ></option>
                    <option value="1" <?php if(isset($_GET['char']) && $_GET['char']== 1) echo "selected"; ?> >A</option>
                    <option value="2" <?php if(isset($_GET['char']) && $_GET['char']== 2) echo "selected"; ?> >B</option>
                    <option value="3" <?php if(isset($_GET['char']) && $_GET['char']== 3) echo "selected"; ?> >C</option>
                    <option value="4" <?php if(isset($_GET['char']) && $_GET['char']== 4) echo "selected"; ?> >D</option>
                    <option value="5" <?php if(isset($_GET['char']) && $_GET['char']== 5) echo "selected"; ?> >E</option>
                    <option value="6" <?php if(isset($_GET['char']) && $_GET['char']== 6) echo "selected"; ?> >F</option>
                    <option value="7" <?php if(isset($_GET['char']) && $_GET['char']== 7) echo "selected"; ?> >G</option>
                    <option value="8" <?php if(isset($_GET['char']) && $_GET['char']== 8) echo "selected"; ?> >H</option>
                    <option value="9" <?php if(isset($_GET['char']) && $_GET['char']== 9) echo "selected"; ?> >I</option>
                    <option value="10" <?php if(isset($_GET['char']) && $_GET['char']== 10) echo "selected"; ?> >J</option>
                    <option value="11" <?php if(isset($_GET['char']) && $_GET['char']== 11) echo "selected"; ?> >K</option>
                    <option value="12" <?php if(isset($_GET['char']) && $_GET['char']== 12) echo "selected"; ?> >L</option>
                    <option value="13" <?php if(isset($_GET['char']) && $_GET['char']== 13) echo "selected"; ?> >M</option>
                    <option value="14" <?php if(isset($_GET['char']) && $_GET['char']== 14) echo "selected"; ?> >N</option>
                    <option value="15" <?php if(isset($_GET['char']) && $_GET['char']== 15) echo "selected"; ?> >O</option>
                    <option value="16" <?php if(isset($_GET['char']) && $_GET['char']== 16) echo "selected"; ?> >P</option>
                    <option value="17" <?php if(isset($_GET['char']) && $_GET['char']== 17) echo "selected"; ?> >Q</option>
                    <option value="18" <?php if(isset($_GET['char']) && $_GET['char']== 18) echo "selected"; ?> >R</option>
                    <option value="19" <?php if(isset($_GET['char']) && $_GET['char']== 19) echo "selected"; ?> >S</option>
                    <option value="20" <?php if(isset($_GET['char']) && $_GET['char']== 20) echo "selected"; ?> >T</option>
                    <option value="21" <?php if(isset($_GET['char']) && $_GET['char']== 21) echo "selected"; ?> >U</option>
                    <option value="22" <?php if(isset($_GET['char']) && $_GET['char']== 22) echo "selected"; ?> >V</option>
                    <option value="23" <?php if(isset($_GET['char']) && $_GET['char']== 23) echo "selected"; ?> >W</option>
                    <option value="24" <?php if(isset($_GET['char']) && $_GET['char']== 24) echo "selected"; ?> >X</option>
                    <option value="25" <?php if(isset($_GET['char']) && $_GET['char']== 25) echo "selected"; ?> >Y</option>
                    <option value="26" <?php if(isset($_GET['char']) && $_GET['char']== 26) echo "selected"; ?> >Z</option>
                </select>
            </div>
            <div class="item">
                <!-- Get Current Value from input bar -->
                <?php
                if (isset($_GET['searchBar']) && !empty($_GET['searchBar'])){
                    $searchValue = $_GET['searchBar'];
                }else{
                    $searchValue = "";
                }

                ?>
                <input type="text" name="searchBar" placeholder="Keywords" class="in1" value="<?php echo $searchValue ?>">
            </div>  
            <div class="item">
                <select name="type">
                    <option></option>
                    <option <?php if(isset($_GET['type']) && $_GET['type']== 1) echo "selected"; ?> value="1">Friend</option>
                    <option <?php if(isset($_GET['type']) && $_GET['type']== 2) echo "selected"; ?> value="2">Relation</option>
                    <option <?php if(isset($_GET['type']) && $_GET['type']== 3) echo "selected"; ?> value="3">Co-Worker</option>
                    <option <?php if(isset($_GET['type']) && $_GET['type']== 0) echo "selected"; ?> value="0" >Other</option>
                </select>
            </div>
            
            <div class="item">
                <label class="gender">Male <input type="radio" name="gender" value="1" <?php if(isset($_GET['gender']) && $_GET['gender']== 1) echo "checked"; ?> ></label>
                <label class="gender">Fe-Male <input type="radio" name="gender" value="2" <?php if(isset($_GET['gender']) && $_GET['gender']== 2) echo "checked"; ?> ></label>
            </div>
            <div class="item">
                <input type="submit" value="SEARCH" class="in2" name="search">
            </div>
        </form>
        <ul id="row">
            <li class="col1"></li>
            <li class="col2">Name</li>
            <li>Nick</li>
            <li>Mobile No1</li>
            <li>Mobile No2</li>
            <li>Land No</li>
            <li>Type</li>
            <li class="col3">Action</li>
        </ul>

<?php
    include "db_connection.php";

    // Function for display records
    function displayRecords($d,$types){
        
        $user_id = $d['id'];
            echo "<ul>";
            echo "<li class='col1'>";
                if ($d['gender'] ==0){
                    echo "";
                }
                elseif ($d['gender'] ==1){
                    echo "<div class= 'male'></div>";
                }elseif ($d['gender'] ==2){
                    echo "<div class= 'female'></div>";
                }
            echo "</li>";
            echo "<li class= 'col2'>".$d['name']."</li>";
            echo "<li>".$d['nick']."</li>";
            echo "<li>".$d['mobile1']."</li>";
            echo "<li>".$d['mobile2']."</li>";
            echo "<li>".$d['land']."</li>";
            echo "<li>".$types[$d['type']]."</li>";
            echo "<li class='col3'>";
                echo "<a href='view.php?id=".$user_id."'class='view'></a>";
                echo "<a href='edit.php?id=".$user_id."'class='edit'></a>";
                echo "<a href='delete.php?id=".$user_id."'class='delete'></a>";
            echo "</ul>";
    }

    // Add types to array
    $types = array("Other", "Friend","Relation","Co-Worker");
    $limit =15; //Items per page
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] :1; //Get page number in URL or set default value is 1

    // Check if user clicked search button
    if (isset($_GET['search']) && !empty($_GET['search'])){
       // Get SearchBar Value
       $name = $_GET['searchBar'];

       // Get Limitation Value
       if($_GET['rows']== 0) $limit =5;
       elseif($_GET['rows']==1) $limit =10;
       elseif($_GET['rows']==2) $limit =15;
       elseif($_GET['rows']==3) $limit =20;
       elseif($_GET['rows']==4) $limit =25;
       elseif($_GET['rows']==5) $limit =50;
       elseif($_GET['rows']==6) $limit =100;

       // Get Type Value
       $type = $_GET['type']; 
       
       // Get Gender Value
       $gender = $_GET['gender'] ?? null;

       // Get Alphabet Value
       $char = $_GET['char'];
       $alpArray = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
       
       // echo $char;
       $count = 0;
       while ($count<$char){
           $alpChar = $alpArray[$count];
           $count++;
       }
       
       $q= "SELECT * FROM `contacts` WHERE 1 ";

       if (!empty($char)){
           $q .= "AND name LIKE '$alpChar%'";
       }
       if(!empty($name)){
           $q .= "AND name LIKE '%$name%' ";
       }
       if(!empty($type) || $type==0){
           $q .= "AND type='$type' ";
       }
       if(!empty($gender)){
           $q .= "AND gender='$gender' ";
       }

       global $rowCount;

       $getCount = $db->prepare($q);
       $getCount->execute(array());
       $rowCount = $getCount->rowCount();
       echo $rowCount;
       
       // Calculate how many items will show base on page number
       $finalLimit = ($currentPage-1)*$limit;
       // echo $currentPage;
       $q .= " LIMIT $limit OFFSET $finalLimit ";
       $list = $db ->prepare($q);
       $list->execute(array());
       $lData = $list->fetchAll();
       // echo count($lData);
       foreach ($lData as $d){
           displayRecords($d,$types);
       }
    // User not click search button
    }else{
        $finalLimit = ($currentPage-1)*$limit;
        $statement = $db ->prepare("SELECT * FROM `contacts` LIMIT $limit OFFSET $finalLimit");
        $statement->execute(array());
        $data = $statement->fetchAll();
        foreach ($data as $d) {
            displayRecords($d,$types);
        }
    }
    // Get Current URL
    // Append the host(domain name, ip) to the URL.   
    $url= $_SERVER['HTTP_HOST'];
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];
    if (isset($_GET['page'])){
        $currentPageName = substr($url,strrpos($url,"?")+8);
    }else{
        $currentPageName = substr($url,strrpos($url,"?")+1);
    }
    // Check records count of the table
    $countItem = $db->prepare("SELECT COUNT(*) as total FROM contacts");
    $countItem -> execute ();
    $tempResult = $countItem -> fetch (PDO::FETCH_ASSOC);
    $totalItems = $tempResult['total'];

    // Display error massages when not have search result related to search
    if ($rowCount == 0){
        echo "<div class='searchError'>Any records haven't related to your search! Please try again</div>";
    }
    // Calculate how many pages should have for display all records
    $pageCount = ceil($rowCount / $limit); //ceil is use for roundup desimal digits to next whole number
    // Create pagination buttons
    $previousPage = $currentPage - 1;
    $nextPage = $currentPage + 1;
    if ($currentPage!= 1){
        echo "<div id='pagination'>";
        echo "<a href='all.php?page=$previousPage&$currentPageName' class='pg'>Back</a>";
        echo "</div>";
    }
    for ($i=1; $i<=$pageCount; $i++){
        echo "<div id='pagination'>";
        echo "<a href='all.php?page=$i&$currentPageName' class='pg'>$i</a>";
        echo "</div>";
    }
    if ($currentPage != $pageCount && $rowCount != 0){
        echo "<div id='pagination'>";
        echo "<a href='all.php?page=$nextPage&$currentPageName' class='pg'>Next</a>";
        echo "</div>";
    }
?>

<?php include_once "inc_footer.php" ?>