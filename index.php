<?php
//session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Store</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <?php
        include_once('pages/js_css.php')
        ?>
    <![endif]-->
  
  </head>
  <body>
        
  	<?php

  	include_once ('pages/classes.php');
  	?>
    <!--Bootstrap's styles version!-->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                <a class="navbar-brand" href="index.php?page=0">Home</a>  
                <a class="navbar-brand" href="index.php?page=1">Catalog</a>
                <a class="navbar-brand" href="index.php?page=2">Cart</a>
                <a class="navbar-brand" href="index.php?page=3">Register</a>
                <a class="navbar-brand" href="index.php?page=4">Admin</a>
            </div>

              <div class="hid">
                <div id="navbar" class="navbar-collapse collapse">
                  <form action='index.php' method='POST' class="navbar-form navbar-right">
                      <div class="form-group">
                          <input type="text" name='logname' size='10' placeholder="Username" class="form-control">
                      </div>
                    
                      <div class="form-group">
                          <input type="password" name='logpass' size='10' placeholder="Password" class="form-control">
                      </div>
                      <button type="submit" name ='log' class="btn btn-success" id="sign">Sign in</button>
                  </form>
              </div><!--/.navbar-collapse -->
            </div>
        </div>
        </nav>
        <div class="row emptyrow">
          
        </div>
        
<?php 
    if(!isset($_POST['additem'])){

?>
    
    <div class="container-fluid all-block__container_height">
         

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-center">
              <div class="container-fluid sidebar">
                  <p><a href="#">Link</a></p>
                  <p><a href="#">Link</a></p>
                  <p><a href="#">Link</a></p>
              </div>
            </div>
            
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 main-content"> 
                
                <div class="container content">
                  <?php
                    include_once ('pages/menu.php')
                  ?>
                </div>
               
            </div>
     
<!--        <div class="container-fluid text-center footer">-->
<!--          <p>Footer Text</p>-->
<!--        </div>-->

    </div>
       

        <?php
            } else{
                $path="";
                if(is_uploaded_file($_FILES['imagepath']['tmp_name'])){
                    $path = "images/Items/".$_FILES['imagepath']['name'];
                    move_uploaded_file($_FILES['imagepath']['tmp_name'], $path);
                }
                $catid=$_POST['catid'];
                $pricesale=$_POST['pricesale'];
                $pricein=$_POST['pricein'];
                $name=trim(htmlspecialchars($_POST['name']));
                $info=trim(htmlspecialchars($_POST['info']));
                $item=new Item($name, $catid, $pricein, $pricesale, $info, $path);
                
                $item->intoDb();

            }
        ?>

  

	 </body>
</html>
