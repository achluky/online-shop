<?php
    @session_start();
    if(!isset($_SESSION['username'])){
        if(isset($_POST['username']) && isset($_POST['password'])){
            $username = mysqli_real_escape_string($GLOBALS['mysqli'],$_POST['username']);
            $password = mysqli_real_escape_string($GLOBALS['mysqli'],$_POST['password']);
            $sql = "SELECT *FROM login WHERE username='$username' AND password='".md5($password)."'";
            
            //Login Sukses
            if(JumlahData($sql)>0){
                $_SESSION['username'] = $username;
                echo "<meta http-equiv='refresh' content='0,admin'>";
                login();
                exit();
            }

            //Login Gagal
            else{  
                login();
                echo "<meta http-equiv='refresh' content='0,'>";
                exit();
            }
        }

        //Belum Login
        else{
            login();
        }
    }

    //Sudah Login, namun ingin mengakses menu login
    else{
        //session_start(); session_destroy();
        echo "<meta http-equiv='refresh' content='0,admin'>";
        exit();
    }

function login(){ ?>

    <center>
        <div id="login">
            <div class="panel panel-primary" style="box-shadow:0 0px 0px 0px #87B0D4;max-width:90%; width:500px;height:30%;max-height:70%;background-color:rgba(0,0,0,0.0); border:0px;">
                <form action="" method="POST">
                    <div id="form-user" class="form-group " style="">
                        <input id="username" type="text" name="username" class="form-control" placeholder="Nama Pengguna" style="color:white;font-size:20px;height:50px;background-color:rgba(0,0,0,0.6);">
                    </div>
                    <div id="form-pass" class="form-group ">
                        <input id="password" type="password" name="password" class="form-control" placeholder="Kata Sandi" style="color:white;font-size:20px;font-size:20px;height:50px;background-color:rgba(0,0,0,0.6);">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Login" style="font-size:20px;width:100%;height:50px;background-color:rgba(254, 209, 36, 0.85);">
                </form>
            </div>
        </div>
    </center>

                
<?php
}
?>
