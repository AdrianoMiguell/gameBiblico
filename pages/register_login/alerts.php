<?php
function alertInfo($message)
{
    sleep(2);
    echo "<div id='messageError' class='alert alert-danger position-absolute end-0 bottom-0 m-2' onload='flesh'>" . $message . " </div>";
}

function back()
{
    $ago_page = ($_SERVER['HTTP_REFERER']);
    echo "<a class='btnG btnSimple' href='$ago_page'> Voltar </a>";
}
