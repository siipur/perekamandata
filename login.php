<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Halaman Login</title>
<!-- Core CSS - Include with every page -->
<link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
<link href="assets/css/style.css" rel="stylesheet" />
<link href="assets/css/main-style.css" rel="stylesheet" />

<!-- Javasript untuk validasi login -->
<script type="text/javascript">
$(document).ready(function() {
	$(".text").val('');
	$("#username").focus();
});
function validasi(){
	var username = $("#username").val();
	var password = $("#password").val();
  	if (username.length == 0){
		alert("Anda belum mengisikan Username.");
		$("#username").focus();
		return false();
	}		 
  	if (password.length == 0){
		alert("Anda belum mengisikan Password.");
		$("#password").focus();
		return false();
  	}
	return true();
}
</script>

</head>
<body class="body-Login-back">

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-offset-3">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i>&nbsp; Silahkan login</h3>
                    </div>
                    <div class="panel-body">

                        <form action="cek_login.php" method="POST" onSubmit="return validasi(this)" role="form">
                            <fieldset>
                            	<div class="form-group">
                                	<pre><small>untuk login -> username = admin dan password = admin</small></pre>	                                
                               	</div>
                                <div class="form-group">
                                	<label>Username:</label>
                                    <input type="text" name="username" class="form-control" placeholder="input username" id="username" />
                                </div>
                                <div class="form-group">
                                	<label>Password:</label>
                                    <input type="password" name="password" class="form-control" placeholder="input password" id="password" />
                                </div>
                                <!-- <input type="submit"> -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Masuk</button> 
                                <a href="index.php" class="btn btn-lg btn-danger btn-block">Batal</a>
                            </fieldset>
                            <hr/>
                            <a href="" target="_blank" class="btn btn-social-icon btn-github" style="float:right">
                                <i class="fa fa-github"></i><i class="fa fa-github"></i> Download aplikasi ini di GitHub
                            </a>
                            <div class="clearfix"/>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 
    	NOTE: 
    	class="" 	-> biasanya untuk digunakan dalam penggunaan CSS
		id=""		-> biasanya untuk digunakan dalam penggunaan javascript
	-->

<!-- Core Scripts - Include with every page -->
<script src="assets/plugins/jquery-1.10.2.js"></script>
<script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
<script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>

</body>
</html>
