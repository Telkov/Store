<?php

if(isset($_GET['page']))
{
    if($_GET['page']==0)include_once('pages/home.php');
    if($_GET['page']==1)include_once('pages/catalog.php');
    if($_GET['page']==2)include_once('pages/cart.php');
    if($_GET['page']==3)include_once('pages/register.php');
    if($_GET['page']==4)include_once('pages/admin.php');
}
?>
