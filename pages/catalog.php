<div class="container" style="margin-top: 30px">
	<form action="index.php?page=1" method="POST">
		<div class="row">
			<div class="col-lg-3">
                <select name="catid" class="form-control">
                    <?php

                        $pdo=Tools::connect();
                        $ps=$pdo->prepare('SELECT * FROM Categories');
                        $ps->execute();
                        while ($row=$ps->fetch()){
                            echo '<option value="'.$row['id'].'">'.$row['category'].'</option>';
                        }
                    ?>

                </select>
            </div>

		</div>

		<?php 
			$items=Item::GetItems();
			foreach ($items as $i) {
				$i->draw();
			}
		?>

	</form>

</div>

<script>
	function createCookie(uname, id){
		var date = new Date(new Date().getTime() + 60 * 1000 * 30);
		document.cookie = uname+"="+id+"; path=/; expires=" + date.toUTCString();
	}
</script>

