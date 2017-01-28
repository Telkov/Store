<?php
class Tools
{
	static function connect(
	// $host="10.3.19.1",
	$host="localhost",
	$user="admin",
	// $user="root",
	$pass="123456",
	$dbname="store777")
	{
		$cs='mysql:host='.$host.'; dbname='.$dbname.'; charset=utf8;';
		$options=array(
		PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
		PDO::MYSQL_ATTR_INIT_COMMAND=>'set names utf8');
		try
		{
			$pdo=new PDO($cs, $user, $pass, $options);
			return $pdo;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}
	static function register($name,$pass,$imagepath){
		$name=trim($name);
		$pass=trim($pass);
		if ($name=="" || $pass=="" ) 
		{
			echo "<h3/><span style='color:red;'>
			Fill All Required Fields!</span><h3/>";
			return false;		
		}
		if (strlen($name)<3 || strlen($name)>30 || strlen($pass)<3 ||
		 strlen($pass)>30) 
		{
			echo "<h3/><span style='color:red;'>
			Values Length Must Be Between 3 And 30!</span><h3/>";
			return false;		
		}

		Tools::connect();
		$customer=new Customer($name,$pass, $imagepath);	
		$err=$customer->intoDb();
		if ($err)
		{
			if($err==1062)
				echo "<h3/><span style='color:red;'>
				This Login Is Already Taken!</span><h3/>";
			else
				echo "<h3/><span style='color:red;'>
				Error code:".$err."!</span><h3/>";
			return false;
		}
		return true;
	}
}

//////////////////class Custome//////////////
class Customer
{
	protected $id;
	protected $login;
	protected $pass;
	protected $roleid;
	protected $total;
	protected $discount;
	protected $avatar;
	function __construct($login, $pass, $avatar, $id=0)
    {
		$this->login=$login;
		$this->pass=$pass;
		$this->avatar=$avatar;
		$this->id=$id;
		$this->discount=0;
		$this->total=0;
		$this->roleid=2;
	}
	function intoDb()
    {
		try{
			$pdo = Tools::connect();  //http://phpfaq.ru/pdo
			$ps = $pdo->prepare('insert into Customers (login, pass, roleid, discount, total, avatar) 
			values (:login, :pass, :roleid, :discount, :total, :avatar)');
			//$a = (array)$this;
			//array_shift($a);
			$a = array('login'=>$this->login, 'pass'=>$this->pass, 'roleid'=>$this->roleid, 'discount'=>$this->discount, 'total'=>$this->total, 'avatar'=>$this->avatar);
			$ps->execute($a);

		}
		catch(PDOException $e)	{
			$err=$e->getMessage();
			echo $err;
		}
	}
	static function fromDb()
    {
		$cust=null;
		try{
			$pdo=Tools::connect();
			$ps=$pdo->prepare("select * from Customers where id=?");
			$ps->execute(array($id));
			$row=$ps->fetch();
			$customer=new Customer($row['login'], $row['pass'], $row['avatar'], $row['id']);
			return $customer;

		}
		catch(PDOException $e)	{
			$err=$e->getMessage();
			echo $err;
		}
	}
}

class Categories
{
    public $id, $category;

    function __construct($category, $id=0)
    {
        $this->id = $id;
        $this->category = $category;
    }

    function intoDb()
    {

    try{
    	$pdo=Tools::connect();
		$ps=$pdo->prepare('INSERT INTO Categories (category) 
					values(:category)');
		$ar=array('category'=>$this->category);
			
		$ps->execute($ar);
    }
    catch(PDOException $e){
			$err=$e->getMessage();
			echo $err;
		}
	}


}
class Item
{
    public $id, $itemname, $catid, $pricein, $pricesale, $info, $rate, $imagepath, $action;

    function __construct($itemname, $catid, $pricein, $pricesale, $info, $imagepath, $rate=0, $action=0, $id=0)
    {
        $this->id = $id;
        $this->itemname = $itemname;
        $this->catid = $catid;
        $this->pricein = $pricein;
        $this->pricesale = $pricesale;
        $this->info = $info;
        $this->rate = $rate;
        $this->imagepath = $imagepath;
        $this->action = $action;
    }
    function intoDb()
    {


    try{
    	$pdo=Tools::connect();
		$ps=$pdo->prepare('INSERT INTO Items (itemname, catid, pricein, pricesale, info, rate, imagepath,action) 
					values(:itemname, :catid, :pricein, :pricesale, :info, :rate, :imagepath, :action)');
		$ar=array(
			'itemname'=>$this->itemname, 
			'catid'=>$this->catid, 
			'pricein'=> $this->pricein, 
			'pricesale'=>$this->pricesale, 
			'info'=> $this->info, 
			'rate'=>$this->rate, 
			'imagepath'=>$this->imagepath, 
			'action'=>$this->action);

		$ps->execute($ar);
    }
    catch(PDOException $e){
			$err=$e->getMessage();
			echo $err;
		}
	}

	static function fromDb($id)
	{
		try{
    	$pdo=Tools::connect();
    	$ps=$pdo->prepare('SELECT * FROM Items WHERE id=?');
    	$ps->execute(array($id));
    	$row=$ps->fetch();
    	$item=new Item(
    		$row['itemname'], 
    		$row['catid'],
    		$row['pricein'],
    		$row['pricesale'],
    		$row['info'],
    		$row['imagepath'],
    		$row['rate'],
    		$row['action'],
    		$row['id']);
    	return $item;

    }
    catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}
	
	function Draw()
	{
		echo "<div class='col-sm-3 col-md-3 col-lg-3 container'
	style='height:350px;margin:2px;'>";
		//itemInfo.php contains detailed info about product
		echo "<div class='row' style='margin-top:2px;
	background-color:#ffd2aa;'>";
		echo "<a href='pages/itemInfo.php?name=".$this->id."' 
	class='pull-left' style='margin-left:10px;'' target='_blank'>";
		echo $this->itemname;
		echo "</a>";
		echo "<span class='pull-right' style='margin-right:10px;'>";
		echo $this->rate."&nbsp;rate";
		echo "</span>";
		echo "</div>";
		echo "<div style='height:100px;margin-top:2px;' class='row'>";
		
		echo "<img src='".$this->imagepath."' height='100px' />";
		echo "<span class='pull-right' style='margin-left:10px;color:red;
	font-size:16pt;'>";
		echo "$&nbsp;".$this->pricesale;
		echo "</span>";

		echo "</div>";
		echo "<div class='row' style='margin-top:10px;'>";
		echo "<p class='text-left col-xs-12' style='background-color:lightblue;
	overflow:auto;height:60px;'>";
		echo $this->info;
		echo "</p>";
		echo "</div>";
		echo "<div class='row' style='margin-top:2px;'>";
			
		echo "</div>";
		echo "<div class='row' style='margin-top:2px;'>";
		//creating cookies for the cart
		//will be explained later
		$ruser='';
		if(!isset($_SESSION['reg']) || $_SESSION['reg'] =="")
		{
			$ruser="cart_".$this->id;
		}
		else
		{
			$ruser=$_SESSION['reg']."_".$this->id;
		}
		echo "<button class='btn btn-success col-xs-offset-1 col-xs-10' 
		onclick=createCookie('".$ruser."','".$this->id."')>
	Add To My Cart</button>";
		echo "</div>";
		echo "</div>";
	}

	static function GetItems($catid=0)	
	{
		$items=null;
		try{
			$pdo=Tools::connect();
			if($catid==0)
			{
				$ps=$pdo->prepare('SELECT * FROM Items');
				$ps->execute();
			}
			else
			{
				$ps=$pdo->prepare('SELECT * FROM Items Where categoryid=?');
				$ps->execute(array($catid));
			}
			while ($row=$ps->fetch())
			{
				$i=new Item($row['itemname'], $row['catid'], $row['pricein'], $row['pricesale'], $row['info'],
							$row['imagepath'], $row['rate'], $row['action'], $row['id']);
				$items[]=$i;
			}
			return $items;
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();
		return false;
		}
	}
}

?>