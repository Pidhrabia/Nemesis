<?php
    require_once('content.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    <link rel="icon" href="../../images/favicon/favicon.png">
    <title>Адміністративна панель</title>
</head>
<body>
    <div class="wrapper">
        <div class="content">
            <h2>Адмін - панель</h2>
            <div class="block">
                <div class="block__item">
                    <div class="block__title section">Профіль адміністратора</div>
                    <div class="block__text">
                        <div class="profile">
                            <div class="profile_info">
                                <div class="logo"><?php show_logo();?></div>
                                <div class="info">
                                    <p><span class="name"><?php echo $user['name'];?></span>
                                    <span class="name"><?php echo $user['surname'];?></span>
                                    <span class="year"><?php echo $user['age'];?></span></p>
                                    <p><span class="email"><?php echo $user['email'];?></span></p>
                                    <p><span class="phone"><?php echo $user['phone'];?></span></p>
                                    <p><a href="exit.php">Вийти з акаунта</a></p>
                                </div>
                            </div>
                        
                            <div class="block">
                                <div class="block__item">
                                    <div class="block__title settings">Налаштування акаунта</div>
                                    <div class="block__text">
                                        <div class="contacts">
                                            <form action="content.php" method="post" enctype="multipart/form-data">
                                                <label for="logo">
                                                    <h3>Аватар:</h3>
                                                    <input type="file" name="file">
                                                </label>
                                                <label for="name">
                                                    <h3>Ім'я:</h3>
                                                    <input id="name" type="text" name="name" placeholder="Ім'я">
                                                </label>
                                                <label for="surname">
                                                    <h3>Прізвище:</h3>
                                                    <input type="text" name="surname" placeholder="Прізвище">
                                                </label>
                                                <label for="age">
                                                    <h3>Вік:</h3>
                                                    <input type="text" name="age" placeholder="Вік">
                                                </label>
                                                <label for="phone">
                                                    <h3>Телефон:</h3>
                                                    <input type="text" name="phone" placeholder="Телефон">
                                                </label>
                                                <button type="submit" name="add__info">Зберегти інформацію</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block">
                <div class="block__item">
                    <div class="block__title section">Портфоліо</div>
                    <div class="block__text slide">
                        <a class="add_slide" href="data/addPortfolio.php">Додати нову роботу</a>
                        <div class="portfolio__content">
                            <?php show_portfolio();?>
                        </div>
                    </div>  
                </div>
            </div>

            <div class="block">
                <div class="block__item">
                    <div class="block__title section">Блог</div>
                    <div class="block__text price">
                        <a class="add_price" href="data/addBlog.php">Додати новий блог</a>
                        <div class="blog__content">
                            <?php show_blog();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                             

    <script src="../../js/jquery-3.6.3.min.js"></script>
    <script src="settings.js"></script>
    <script src="price.js"></script>
    <script src="slider.js"></script>
</body>
</html>