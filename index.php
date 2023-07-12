<?php 

include "php/databases.php";
$result = mysqli_query($induction,"SELECT * FROM `terms`");
$words =mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Словарь</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header id="header" class="header">
        <div class="wrapper">
            <div class="header-wrapper">
                <div class="header-logo">
                    <a href="#" class="header-logo-link">
                        <img src="./source/header-logo.png" alt="Откройте для себя новые знания" class="header-logo-pic">
                    </a>
                </div>
                <nav class="header-nav">
                    <ul class="header-list">
                        <li class="header-item">
                            <a href="#" class="header-link">
                                <img src="./source/youtube.png" alt="Youtube-logo" class="header-nav-pic">
                            </a>
                        </li>
                        <li class="header-item">
                            <a href="#" class="header-link">
                                <img src="./source/facebook.png" alt="Facebook-logo" class="header-nav-pic">
                            </a>
                        </li>
                        <li class="header-item">
                            <a href="#" class="header-link">
                                <img src="./source/twitter.png" alt="Twitter-logo" class="header-nav-pic">
                            </a>
                        </li>
                        <li class="header-item">
                            <a href="#" class="header-link">
                                <img src="./source/vk.png" alt="Vk-logo" class="header-nav-pic">
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main class="main">
        <section class="intro">
            <div class="wrapper">
                <h1 class="intro-title">
                    Откройте для себя новые знания
                </h1>
                <p class="intro-subtitle">
                    Словарь-справочник для всех
                </p>
                <div class="intro-link">
                    <a href="#area2" class="intro-button">
                        <p class="intro-desc">
                            Перейти
                        </p>
                    </a>
                </div>
            </div>
        </section>
        <section class="dictionary">
            <div class="wrapper">
                <h2 id="area2" class="dictionary-title" >
                    Словарь-справочник
                </h2>
                <div class="dictionary-choice">
                    <div class="dictionary-search">
                        <img id="loop" src="./source/search.png" alt="Search" class="dictionary-search-pic">
                        <input id="global_search" type="text" class="search" placeholder="Поиск">
                    </div>
                    <div class="dictionary-language">
                        <select name="" id="" class="change-language">
                            <option value="ru">Русский</option>
                            <option value="en">English</option>
                        </select>
                    </div>
                </div>
                <div class="alphabet-container">
                    <div class="alphabet">
                        <ul class="letters">
                            <?php
                                $index = 0;
                                $stack = array();
                                while($words = mysqli_fetch_assoc($result)){
                                    array_push($stack,mb_substr($words['term_ru'], 0, 1));
                                    $index++;
                                }  
                                $distinct = array_filter(array_unique($stack));
                                sort($distinct);
                                $index = 0;
                                $class_letter1 = "letter-item-none";
                                $class_letter2 = "letter-item";
                                while ($index < count($stack)) {                    
                                    ?>
                                    <li class="<?php if($distinct[$index]==""){echo $class_letter1; }else{echo $class_letter2;}?>">
                                        <a href="#letter<?php echo $index?>" class="letter-link"><?php 
                                            echo $distinct[$index];
                                            $index++;
                                            ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                                mysqli_data_seek($result, 0);
                                $number = array();
                                while($words = mysqli_fetch_assoc($result)){
                                    array_push($number,"number".$words['id']);
                                }
                                mysqli_data_seek($result, 0);
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="terms-lines">
                    <?php 
                    $index_letter=0;
                    $index_title=0;
                    $id_title = array();
                    $id_title_base = array();
                    $id_desc_base = array();
                    $index_modal=0;
                    echo "<script>";
                    echo "var params = {};";
                    echo "var titles = {};";
                    echo "var descs = {};";
                    echo "var len;";
                    echo "</script>";
                    while ($index_letter < count($distinct)){ 
                        ?>
                    <div class="terms-line">
                        <div class="terms-left">
                            <div class="terms-letter">
                                <p id="<?php $letter_nubmer = "letter".$index_letter; echo $letter_nubmer ?>"><?php echo $distinct[$index_letter].mb_strtolower($distinct[$index_letter]);?></p>
                            </div>
                            <div class="terms-count">
                                <p><span>
                                    <?php 
                                    $counter=0; 
                                    while($words = mysqli_fetch_assoc($result)){
                                        if(mb_substr($words['term_ru'],0, 1) == $distinct[$index_letter]){
                                            $counter++;
                                        }
                                    }
                                    mysqli_data_seek($result, 0); 
                                    echo $counter; 
                                    ?>
                                </span> термина</p>
                            </div>
                        </div>
                        <div class="terms-right">
                            <ul class="terms-list">
                                <?php
                                $index=0;
                                    while($words = mysqli_fetch_assoc($result)){
                                        if(mb_substr($words['term_ru'],0, 1) == $distinct[$index_letter]){
                                            $class = "terms-item";  
                                            $id_class = "number".$words['id'] ;
                                            $local_title = $words['term_ru'] ;
                                            $local_desc = $words['description'] ;
                                            array_push($id_title, $id_class);  
                                            array_push($id_title_base, $local_title); 
                                            array_push($id_desc_base, $local_desc);   
                                        }else {
                                            $class = "terms-item-none";
                                        } 
                                ?>
                                        <li class="<?php echo $class;?>">
                                            <a href="#header" id="<?php echo $id_class; ?>" class="term">
                                                <?php 
                                                    if(mb_substr($words['term_ru'],0, 1) == $distinct[$index_letter]){
                                                    echo $words['term_ru'];
                                                    }
                                                ?>
                                            </a>
                                        </li>
                                   <?php }mysqli_data_seek($result, 0);
                                ?>     
                            </ul>
                        </div>
                    </div>
                    <?php
                    echo "<script>";
                    echo "len = '" . count($id_title) . "';";
                    echo '</script>'; 
                    while($index_title<count($id_title)) {
                        echo "<script>";
                        echo "params['param" . $index_title . "'] = '" . $id_title[$index_title] . "';";
                        echo "titles['title" . $index_title . "'] = '" . $id_title_base[$index_title] . "';";
                        echo "descs['desc" . $index_title . "'] = '" . $id_desc_base[$index_title] . "';";
                        echo '</script>';      
                        $index_title++;
                    }
                    $index_letter++;
                    }
                    ?>
                    <div class="modal" id="my-modal">
                        <div class="modal__box">
                            <button class="modal__close-btn" id="close-my-modal-btn">
                                <svg width="23" height="25" viewBox="0 0 23 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.09082 0.03125L22.9999 22.0294L20.909 24.2292L-8.73579e-05 2.23106L2.09082 0.03125Z"
                                        fill="#333333" />
                                    <path d="M0 22.0295L20.9091 0.0314368L23 2.23125L2.09091 24.2294L0 22.0295Z" fill="#333333" />
                                </svg>
                            </button>
                            <h2 id="title" class="tit"></h2>
                            <p id="desc" class="des"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script defer src="./js/script.js"></script>
</body>
</html>
