<?php   
 
    include "header.php";
?>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-5 col-md-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                       <!--  <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                            <div class="p-5">
                            <div class="text-center">
                                </div>
                                </div> -->
                            </div><!-- 
                            <div class="col-lg-6"> -->
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><b>SELAMAT DATANG </b>
                                        <br> <small> DI SISTEM INFORMASI PERPUSTAKAAN
                                        <br>SMK YPKK 1 Sleman</small></h1>


                                <img src="assets/img/LOGO-YPKK.jpeg" width="150">
                                    </div>
                                    <br>
                                    <form class="user" action="ceklogin.php" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" name="username"
                                                placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="pass"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        
                                        <input type="submit" value="login"  class="btn btn-primary btn-user btn-block">
                                        
                                        
                                    </form>
                                    <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

<?php   
 
    include "footer.php";
?>