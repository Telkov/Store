<h3>Registration Form</h3>
<?php
if(!isset($_POST['regbtn']))
{
?>

<form action="index.php?page=3" class="form-horizontal" method="POST" enctype="multipart/form-data"> 
    <div class="form-group">
      <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label" for="login">Login:</label>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <input type="text" class="form-control inp1" name="login" placeholder="Username">
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label" for="pass1">Password:</label>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <input type="password" class="form-control inp1" name="pass1" placeholder="Password">
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label" for="pass2">Confirm Password:</label>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <input type="password" class="form-control inp1" name="pass2" placeholder="Confirm Password">
        </div>
    </div>

    <div class="form-group">
       <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label" for="imagepath">Select image:</label>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <input type="file" name="imagepath">
        </div>
    </div>
    <button type="submit" class="btn btn-primary" 
        name="regbtn">Register</button>
</form>
<?php
}
else
{

    if(isset($_FILES['imagepath'])){
        $path=$_FILES['imagepath']['tmp_name'];
        $fp=fopen($path,'rb');
        $bi=fread($fp, filesize($path));
    }


    if(Tools::register($_POST['login'],$_POST['pass1'],$path))
    {
        echo "<h3/><span style='color:green;'>
            New User Added!</span><h3/>";
    }
}
?>