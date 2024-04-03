<?php
$hostDB='127.0.0.1';
    $nombreDB='trendystyle1';
    $contrasenaDB='';
    $usuarioDB='root';
    $hostPDO="mysql:host=$hostDB;dbname=$nombreDB;";
    $miPDO=new PDO($hostPDO,$usuarioDB,$contrasenaDB);
    ?>