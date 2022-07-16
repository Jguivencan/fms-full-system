<style>
	.nav-item {
    position: relative;
    display: block;
    padding: .75rem 1.25rem;
    margin-bottom: -1px;
    border: 1px solid rgba(0,0,0,.125);
    background-color: #226dbd;
    color: #ffffff;
    font-weight: 600;
	width: 100%;
	height: 100%;
	}

	.nav-item:hover {
    background-color: #fff;
    color: #5d5d5d;
	}

	.nav-item:active {
    background-color: #fff;
    color: #5d5d5d;
	}

	#sidebar {
		background-color: #226dbd;
	}
</style>

<nav id="sidebar">
		
		<?php $active_page=isset($_GET['page']) ?  $_GET['page'] : ''?>
		<div class="sidebar-list">
				<!--<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>-->
				<a href="index.php?page=files" class="nav-item <?php echo $active_page == 'files' ? 'active' : ''   ?>"><span class='icon-field'><i class="fa fa-file"></i></span>  My Files</a>
				<a href="index.php?page=shared_docss" class="nav-item <?php echo $active_page == "shared_docss" ? 'active' : ''   ?>" ><span class='icon-field'><i class="fa fa-share"></i></i></span> Shared Files</a>
				<!--<a href="" class="nav-item"><span class='icon-field'><i class="fa fa-clock"></i></i></span> Recent</a>-->
				<a href="index.php?page=chat" class="nav-item <?php echo $active_page == 'chat' ? 'active' : ''   ?>" ><span class='icon-field'><i class="fa fa-comment"></i></span> Chat</a>
				<a href="index.php?page=trashbin" class="nav-item <?php echo $active_page == 'trashbin' ? 'active' : ''   ?>" ><span class='icon-field'><i class="fa fa-trash"></i></span> Trashbin</a>
				<?php //if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=users" class="nav-item <?php echo $active_page == 'users' ? 'active' : ''   ?>" ><span class='icon-field'><i class="fa fa-users"></i></span> Account</a>
				<?php //endif; ?>
		</div>

</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>