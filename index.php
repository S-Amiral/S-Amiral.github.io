<?php

require 'headerAndFormFuncts.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>S-Amiral</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" type="image/icon" href="./design/samiral.ico" />
</head>
<body>
    <?php getHeader(); ?>
    <section id="main">
        <h1>
            Welcome to the S-Amiral Crew website.
        </h1>
        <h2>
            Our repos!
        </h2>
        <?php
            printRepos(getFromApi('https://api.github.com/orgs/S-Amiral/repos'));
        ?>
        <h2>
            Our public Crew Members!
        </h2>
        <?php
            printMembers(getFromApi('https://api.github.com/orgs/S-Amiral/members'));
        ?>
        <h2>
            There will be more to come...
        </h2>

    </section>
    <footer><?php echo hackTxt('Copyright S-Amiral Crew 2017'); ?></footer>
</body>
</html>
