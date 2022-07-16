<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="style.css">-->
    <title>Document</title>
</head>
<?php 
    include('db_connect.php');
    if(isset($_GET['id'])){
        $user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
        foreach($user->fetch_array() as $k =>$v){
	        $meta[$k] = $v;
        }
    }
?>
<style>
    * {
    font-family: Arial, Helvetica, sans-serif;
    }

    body {
        background-image: url("images/bg.jpg");
        background-size: cover;
    }

    .index-container {
        text-align: left;
        margin-left: 650px;
        margin-top: 200px;
    }

    .holder {
        height: 30px;
        width: 500px;
        border: 1px solid black;
    }

    .button {
        background: #0047AB;
        color: white;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        font-size: 20px;
        border: 1px solid black;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        height: 50px;
        width: 100px;
        cursor: pointer;
    }
</style>
<?php include('./header.php'); ?>

<body>
    <div class="index-container">
        <form action="" id="manage-user">
            <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
            <h1 style="font-weight:900;">Sign Up</h1>
            <label for="name"><h3 style="margin-bottom: 5px;">Name</h3></label><br>
            <input type="text" name="name" id="name" class="holder" placeholder="Enter your name" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required><br>
            <label for="username"><h3 style="margin-bottom: 5px;">Email</h3></label><br>
            <input type="email" name="username" class="holder" placeholder="Enter your email" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required><br>
            <label for="password"><h3 style="margin-bottom: 5px;">Password</h3></label><br>
            <input type="password" name="password" class="holder" placeholder="Enter your password" id="myInput" value="<?php echo isset($meta['password']) ? $meta['id']: '' ?>" required><br>
            <input type="checkbox" onclick="myFunction()" style="margin-top: 10px;">Show Password
            <br><button type="submit" id="submit" class="button" style="margin-top: 10px;" onclick="$('#uni_modal form').submit()">Sign Up</button>
            <h4 style="margin-top: 10px;">Already have an account? Click here to <a href="login_page.php" style="text-decoration:none;">Login</a></h4>
        </form>
    </div>
</body>
</html>
<script src="script.js"></script>
<script>
	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=save_user',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	})
</script>
<script>
	 window.start_load = function(){
    $('body').prepend('<di id="preloader2"></di>')
  }
  window.end_load = function(){
    $('#preloader2').fadeOut('fast', function() {
        $(this).remove();
      })
  }

  window.uni_modal = function($title = '' , $url=''){
    start_load()
    $.ajax({
        url:$url,
        error:err=>{
            console.log()
            alert("An error occured")
        },
        success:function(resp){
            if(resp){
                $('#uni_modal .modal-title').html($title)
                $('#uni_modal .modal-body').html(resp)
                $('#uni_modal').modal('show')
                end_load()
            }
        }
    })
}
window._conf = function($msg='',$func='',$params = []){
     $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
     $('#confirm_modal .modal-body').html($msg)
     $('#confirm_modal').modal('show')
  }
   window.alert_toast= function($msg = 'TEST',$bg = 'success'){
      $('#alert_toast').removeClass('bg-success')
      $('#alert_toast').removeClass('bg-danger')
      $('#alert_toast').removeClass('bg-info')
      $('#alert_toast').removeClass('bg-warning')

    if($bg == 'success')
      $('#alert_toast').addClass('bg-success')
    if($bg == 'danger')
      $('#alert_toast').addClass('bg-danger')
    if($bg == 'info')
      $('#alert_toast').addClass('bg-info')
    if($bg == 'warning')
      $('#alert_toast').addClass('bg-warning')
    $('#alert_toast .toast-body').html($msg)
    $('#alert_toast').toast({delay:3000}).toast('show');
  }
  $(document).ready(function(){
    $('#preloader').fadeOut('fast', function() {
        $(this).remove();
      })
  })
</script>	