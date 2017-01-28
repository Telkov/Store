<?php 
    if(!isset($_POST['additem'])){

?>
    
    <form action="index.php?page=4" method="POST" class="form-horizontal">
        <div class="form-group">
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label" for="newcat">New Category:</label>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <input type="text" class="form-control inp1" name="newcat" placeholder="New Category...">
            </div>
        </div>
        
        <input type='submit' value="Add Cat-y" name="addcat" class="btn btn-primary">
    </form>
    
    <br>

    <form action="index.php?page=4" method="POST" class="form-horizontal" enctype="multipart/form-data">
        <p style="margin-top: 10px"><h5><b>Select Category and Enter new Item</b></h5></p>
       
        <div class="form-group">
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label" for="catid">Category:</label>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <select class="form-control Additem__sel1_style" name="catid">
                   <?php
                        $pdo=Tools::connect();
                        $list=$pdo->query("SELECT * FROM Categories");
                        while ($row=$list->fetch()){
                        echo '<option value="'.$row['id'].'">'.$row['category'].'</option>';
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label" for="name">Item name:</label>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <input type="text" class="form-control Additem__inp1_style" name="name" placeholder="New Item...">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label" for="info">Item info:</label>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <textarea name="info" class="form-control Additem__txtar1_style" placeholder="Info..."></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label" for="pricein">Price in:</label>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <input type="text" class="form-control Additem__inp1_style" name="pricein" placeholder="Price In...">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label" for="pricesale">Price sale:</label>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <input type="text" class="form-control Additem__inp1_style" name="pricesale" placeholder="Price Sale...">
            </div>
        </div> 

        <div class="form-group">
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label" for="pricesale">Item image</label>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <input type='file' name ='imagepath' class="btn Additem__but1_style" accept="image/*">
            </div>
        </div> 
              
        <br>
        <input type='submit' value="Add Item" name="additem" class="btn btn-primary">
    </form>

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

<?php
    if (isset($_POST['addcat'])){
        $newcat=trim(htmlspecialchars($_POST['newcat']));
        $category = new Categories($newcat);
        $category->intoDb();
    }
?>

