<?php
    require_once('connect.php');


    function cityName(){
        global $mysql;

        $name = $mysql->query("SELECT DISTINCT `name` FROM `portfolio`");
        echo '<ul>
            <li><a href="#" data-filter="all">Усі</a></li>
        ';
        
        while($row = mysqli_fetch_assoc($name)){
            echo '<li><a href="#" data-filter="'.$row['name'].'">'.$row['name'].'</a></li>';
        }
        echo '</ul>';
    }


    function portfolio(){
        global $mysql;
        $query = $mysql->query("SELECT * FROM `portfolio`");

        while($row = mysqli_fetch_assoc($query)){
            $path = 'portfolio/'.$row['time'].' '.$row['name'].' '.$row['client'].'/gallery/';

            echo'
                <li>
                    <div class="inner" data-title="'.$row['name'].'">
                        <div class="entry nemesis_tm_portfolio_animation_wrap" data-title="'.$row['name'].'" data-category="'.$row['type'].'"> 
                            <a class="popup_info" href="#">
                                <img src="portfolio/'.$row['time'].' '.$row['name'].' '.$row['client'].'/'.$row['name_photo'].'" />
                            </a> 
                        </div>
                    </div>
                    <div class="details_all_wrap">
                        <div class="popup_details">
                            <div class="top_image"><img src="portfolio/'.$row['time'].' '.$row['name'].' '.$row['client'].'/'.$row['name_photo'].'" /></div>
                            <div class="portfolio_main_title"></div>
                            <div class="main_details">
                                <div class="textbox">
                                    <p>'.$row['description'].'</p>
                                </div>
                                <div class="detailbox">
                                    <ul>
                                        <li> <span class="first">Client</span> <span>'.$row['client'].'</span> </li>
                                        <li> <span class="first">Date</span> <span>'.date("F d, Y", strtotime($row['date'])).'</span> </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="additional_images">
                                <ul>
                                    <li>
                                        <div class="list_inner">
                                            <div class="my_image">';
                                                    $path = 'portfolio/'.$row['time'].' '.$row['name'].' '.$row['client'].'/gallery/';

                                                    if ($open = scandir($path)) {
                                                        foreach ($open as $k => $v) {
                                                            if ($v != "." && $v != "..") {
                                                                echo '
                                                                <div class="main">                                                              
                                                                    <img src="'.$path.$v.'">
                                                                </div>'; 
                                                            }
                                                        }
                                                    }
                                            echo'</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            ';
        }
    }

    function blog(){
        global $mysql;
        $query = $mysql->query("SELECT * FROM `blog`");
        while($row = mysqli_fetch_assoc($query)){
            echo'
                <li>
                    <div class="list_inner">
                        <div class="image"> <img src="../blog/'.$row['time'].' '.$row['date'].' '.$row['who'].'/'.$row['name_photo'].'">
                            <div class="main"><img src="../blog/'.$row['time'].' '.$row['date'].' '.$row['who'].'/'.$row['name_photo'].'"></div> <a class="nemesis_tm_full_link" href="#"></a> </div>
                        <div class="details">
                            <div class="extra">
                                <div class="short">
                                    <p class="date">By<a href="#"> '.$row['who'].'</a> <span>'.date("d F Y", strtotime($row['date'])).'</span></p>
                                </div>
                                <div class="my_like"> <a href="#"><img class="svg" src="img/svg/like.svg" alt="" /><span>55</span></a> </div>
                            </div>
                            <h3 class="title"><a href="#">'.$row['name'].'</a></h3>
                            <div class="nemesis_tm_read_more"> <a href="#"><span>Читати</span></a> </div>
                        </div>
                        <div class="main_content">
                            <div class="descriptions">
                                <p>'.nl2br(($row['description'])).'</p>
                                <div class="news_share"> <span>Посилання:</span>
                                    <ul>
                                        <li><a href="#"><img class="svg" src="img/svg/social/facebook.svg" alt="" /></a></li>
                                        <li><a href="#"><img class="svg" src="img/svg/social/twitter.svg" alt="" /></a></li>
                                        <li><a href="#"><img class="svg" src="img/svg/social/instagram.svg" alt="" /></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            ';
        }
    }

?>