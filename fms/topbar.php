<style>
	.logo {
    margin: auto;
    font-size: 20px;
    border-radius: 50% 50%;
    color: #000000b3;
	}

	.dropbtn {
		background-color: #226dbd;
		color: white;
		height: 40px;
		width: 105px;
		font-size: 16px;
		border: none;
		cursor: pointer;
		border-radius: 25px 25px 25px 25px;
	}

	.dropdown {
		margin-left: 1190px;
	}

	.dropdown-content {
		display: none;
		position: absolute;
		background-color: #226dbd;
		min-width: 160px;
		overflow: auto;
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		z-index: 1;
	}

	.dropdown-content a {
		color: white;
		padding: 12px 16px;
		text-decoration: none;
		display: block;
	}

	.dropdown a:hover {
		background-color: white;
		color: black;
	}

	.show {
		display: block;
	}
</style>

<nav class="navbar navbar-dark bg-dark fixed-top " style="padding:0;">
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
  		<div class="col-md-1 float-left" style="display: flex; margin-left:-45px;">
  			<div class="logo">
				<img src="images/toplogo.png" style="height:45px; width:45px;">
  			</div>
  		</div>
	  	<div class="col-md-2">
			<div class="dropdown">
				<button onclick="myFunction()" class="dropbtn">Account <i class="fa fa-user"></i></button>
				<div id="myDropdown" class="dropdown-content">
					<a href="ajax.php?action=logout"><?//php echo $_SESSION['login_name'] ?>Logout <i class="fa fa-power-off"></i></a>
				</div>
			</div>
	    </div>
    </div>
  </div>
  
</nav>
<script>
	function myFunction() {
		document.getElementById("myDropdown").classList.toggle("show");
	}

	window.onclick = function(event) {
		if (!event.target.matches('.dropbtn')) {
			var dropdowns = document.getElementsByClassName("dropdown-content");
			var i;
			for (i = 0; i < dropdown.lengths; i++) {
				var openDropdown = dropdowns[i];
				if (openDropdown.classlist.contains('show')) {
					openDropdown.classlist.remove('show');
				}
			}
		}
	}
</script>