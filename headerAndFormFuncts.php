<?php

function getHeader()
{
    // ------------------ Récupération des éclairs et du S-Amiral
    $fichier = "./design/samiral.txt";
    $fichier2 = "./design/lBefore.txt";
    $fichier3 = "./design/lAfter.txt";
    $samiral = "";
    // on ouvre le fichier
    $fp = fopen($fichier, "r");
    $fpb = fopen($fichier2, "r");
    $fpa = fopen($fichier3, "r");
    // on ouvre le fichier
    // tant qu'on est pas au bout du fichier on continue de lire
    while (!feof($fp)&&!feof($fpb)&&!feof($fpa)) {
        // On récupère une ligne
        $samiral .= '<span class="lightning">'.htmlentities(rtrim(fgets($fpb), "\r\n")).'</span>';
        $samiral .= '<span class="samiral">'.htmlentities(rtrim(fgets($fp), "\r\n")).'</span>';
        $samiral .= '<span class="lightning">'.htmlentities(fgets($fpa)).'</span>';
    }
    fclose($fp);
    fclose($fpb);
    fclose($fpa);
    // ------------------ Récupération des skulls
    $fichier = "./design/skull.txt";
    $skull = "";
    // on ouvre le fichier
    $fp = fopen($fichier, "r");
    // tant qu'on est pas au bout du fichier on continue de lire
    while (!feof($fp)) {
        // On récupère une ligne
        $skull .= fgets($fp);
    }
    fclose($fp);
    echo '
    <section id="header">
    <pre class="titre">'.htmlentities($skull).'</pre>
    <pre class="titre">'.$samiral.'</pre>
    <pre class="titre">'.htmlentities($skull).'</pre>
    </section>';
}

function getFromApi($link)
{
    $client_id = getenv('CLIENT_ID');
    $client_secret = getenv('CLIENT_SECRET');
    $link_with_credentials = $link."?client_id=$client_id&client_secret=$client_secret";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $link_with_credentials);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt(
        $ch,
        CURLOPT_USERAGENT,
        'travis-ci'
    );
    $jsonString = curl_exec($ch);
    curl_close($ch);
    return(json_decode($jsonString));
}

function printRepos($repos)
{
    foreach ($repos as $repo) {
        echo '<a class="connectGoogle" href="'.$repo->html_url.'">'.$repo->full_name.'</a><br>';
        if ($repo->homepage!==null) {
            $arrow = '<span style="font-size: 1.5em; color : white; margin-left:1vw;">&#x21AA</span>';
            echo '<a class="connectGoogle" href="'.$repo->homepage.'"> '.$arrow.' Relative github page</a><br>';
        }
    }
}

function printMembers($members)
{
    foreach ($members as $member) {
        $avatar = '<img class="avatar" src="'.$member->avatar_url.'" alt="Member avatar">';
        echo '<div><a class="connectGoogle" href="'.$member->html_url.'">'.$avatar.$member->login.'</a></div>';
        /*if ($member->blog!==null) {
            $arrow = '<span style="font-size: 1.5em; color : white; margin-left:1vw;">&#x21AA</span>';
            echo '<a class="connectGoogle" href="'.$member->blog.'"> '.$arrow.' User blog</a><br>';
        }*/
    }
}


function hackTxt($texte)
{
    $search = array("e","E", "O", "o", "s", "S", "a", "A", "i", "I");
    $replace = array("3","3", "0","0", "5", "5", "4", "4", "1", "1");
    return str_replace($search, $replace, $texte);
}
