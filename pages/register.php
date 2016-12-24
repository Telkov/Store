            <?php
            if(!isset($_POST['reg']))
            {
                ?>
                <div class="container" style="margin-top: 20px;">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" >
                            <form action='index.php?page=5' method='post'>
                                <div class="form-group">
                                    <!-- <div class="col-lg-6">-->
                                    <label for='login'>Username:</label>
                                    <input type='text' name='login' class='form-control' placeholder='Username' />
                                    <!--  </div>-->
                                </div>


                                <div class="form-group">
                                    <!-- <div class="col-lg-6">-->
                                    <label for='pass1'>Password:</label>
                                    <input type='password' name='pass1' class='form-control' size='10' placeholder='Password' />
                                    <!--      </div>-->
                                </div>

                                <div class="form-group">
                                    <!-- <div class="col-lg-6">-->
                                    <label for='pass2'>Confirm Password:</label>
                                    <input type='password' name='pass2' class='form-control' size='10' placeholder='Confirm Password' />
                                    <!--  </div>    -->
                                </div>

                                <div class="form-group">
                                    <!--     <div class="col-lg-6">  -->
                                    <label for='email'>Email:</label>
                                    <input type='text' name='email' class='form-control' size='10' placeholder='E-mail' />
                                    <!--      </div>-->
                                </div>
                                <input type='Submit' name='reg' value='Register' class='btn btn-primary btn-gradient' />
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            else
            {

                if(Register($_POST['login'], $_POST['pass1'], $_POST['email']))
                {
                    echo '<h4 style ="color:green;">User Added Succesfuly!</h4>';
                }
            }
            ?>

