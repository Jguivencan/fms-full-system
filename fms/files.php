<?php 
include 'db_connect.php';

function get_search(){
	
	if(isset($_GET['q'])){
		$query = $_GET['q'];
		return " and  (files.name LIKE '%$query%'  or   files.description LIKE '%$query%') ";
	}else{
		return " ";
	}
} 



$file_types = [
	'docs' => '  ',
	'images' => '',
	'videos' => '',
];
function get_by_type($types){
	
	$query = isset($_GET['file_type']) ?  $_GET['file_type'] : null;
	if(isset($_GET['file_type'])  && $query == 'docs'){
		return ' and  files.file_type in ("docx", "pdf", "csv", "xsl", "xlsx", "pptx", "xls")';
	}
	else if(isset($_GET['file_type'])  && $query == 'video'){
		return ' and  files.file_type in ("avi", "mp4", "avi", "webm", "mov")';
	}
	else if(isset($_GET['file_type'])  && $query == 'images'){
		return ' and  files.file_type in ("jpg", "jpeg", "mac")';
	}
	else if(isset($_GET['file_type'])  && $query == 'others'){
		return ' and  files.file_type not in ("docx", "pdf", "csv", "xsl", "xlsx", "pptx", "avi", "mp4", "avi", "webm", "mov", "jpg", "jpeg", "mac", "xls")';
	}
	else{
		return " ";
	}
}

$current_user =  $_SESSION['login_id'];
$folder_parent = isset($_GET['fid'])? $_GET['fid'] : 0;
$folders = $conn->query("SELECT * FROM folders where parent_id = $folder_parent and user_id = '".$_SESSION['login_id']."'  order by name asc");
// echo "<pre>";
// print_r("SELECT * FROM files where folder_id = $folder_parent and user_id = $current_user ". get_search() . get_by_type($file_types) . " and is_deleted != 1  order by name asc");
// die;
$files = $conn->query("SELECT * FROM files where folder_id = $folder_parent and user_id = $current_user ". get_search() . get_by_type($file_types) . " and is_deleted != 1  order by date_updated desc");

// echo "<pre>";
// print_r();
// die;
$users = $conn->query("select users.id, users.username from users where id != $current_user ")->fetch_all(MYSQLI_ASSOC);
// sample edit to commit
?>
<style>
	.folder-item{
		cursor: pointer;
	}
	.folder-item:hover{
		background: #eaeaea;
	    color: black;
	    box-shadow: 3px 3px #0000000f;
	}
	.custom-menu {
        z-index: 1000;
	    position: absolute;
	    background-color: #ffffff;
	    border: 1px solid #0000001c;
	    border-radius: 5px;
	    padding: 8px;
	    min-width: 13vw;
}
a.custom-menu-list {
    width: 100%;
    display: flex;
    color: #4c4b4b;
    font-weight: 600;
    font-size: 1em;
    padding: 1px 11px;
}
.file-item{
	cursor: pointer;
}
a.custom-menu-list:hover,.file-item:hover,.file-item.active {
    background: #80808024;
}
table th,td{
	/*border-left:1px solid gray;*/
}
a.custom-menu-list span.icon{
		width:1em;
		margin-right: 5px
}

.form-control {
	width: 500px;
}

#add {
	margin-left: 250px;
}

</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12"><h4 style="padding-top: 10px;"><b>  My Files</b></h4></div>
	</div>
	<hr>
	<div class="col-lg-12">
		<!--<div class="col-md-4 input-group offset-4">
			<div class="input-group-append">
					<span class="input-group-text" id="inputGroup-sizing-sm"><i class="fa fa-search"></i></span>
			</div>
			<input type="text" class="form-control" id="search">--> <!-- aria-label="Small" aria-describedby="inputGroup-sizing-sm" -->
		<!--</div>-->
		
		<div class="row">
			<div class="col-md-5">
				<form action="index.php" method="get">
					<div class="input-group ">
						<div class="input-group-prepend">
							 <button class="input-group-btn btn" id="basic-addon1"><i class="fa fa-search"></i></button>
						</div>
						<input type="text" class="form-control" name="q" value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''?>">
					</div>
					<input type="hidden" name="page" value="files">
				</form>
			</div>
			<div class="col-md-7">
				<div class="row d-flex" id="add">
					<button class="btn btn-primary btn-sm" id="new_folder"><i class="fa fa-plus"></i> New Folder</button>
					<button class="btn btn-primary btn-sm ml-4" id="new_file"><i class="fa fa-upload"></i> Upload File</button>
				</div>
			</div>
		</div>
		<hr>
		<!-- Search Result -->
		
		<?php if(isset($_GET['q'])):?>
			
			<div class="row">
				<div class="col-md-12"><h4>Search Results!</h4></div>
			</div>
			<div class="row">
					<div class="card col-md-12">
						<div class="card-body">
							<table width="100%" class="table">
								<thead>
									<tr>
										<th span="1">Action</th>
										<th >Filename</th>
										<th class="">Date</th>
										<th class="">Description</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									while($row=$files->fetch_assoc()):
										$name = explode(' ||',$row['name']);
										$name = isset($name[1]) ? $name[0] ." (".$name[1].").".$row['file_type'] : $name[0] .".".$row['file_type'];
										$img_arr = array('png','jpg','jpeg','gif','psd','tif');
										$doc_arr =array('doc','docx');
										$pdf_arr =array('pdf','ps','eps','prn');
										$icon ='fa-file';
										if(in_array(strtolower($row['file_type']),$img_arr))
											$icon ='fa-image';
										if(in_array(strtolower($row['file_type']),$doc_arr))
											$icon ='fa-file-word';
										if(in_array(strtolower($row['file_type']),$pdf_arr))
											$icon ='fa-file-pdf';
										if(in_array(strtolower($row['file_type']),['xlsx','xls','xlsm','xlsb','xltm','xlt','xla','xlr']))
											$icon ='fa-file-excel';
										if(in_array(strtolower($row['file_type']),['zip','rar','tar']))
											$icon ='fa-file-archive';

									?>
										<tr class='file-item' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>">
											<td>
												<div>
													<div class="dropright">
														<button class="btn  dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<span><i class="fa fa-ellipsis-v" aria-hidden="true"></i>	</span>
														</button>
														<div class="dropdown-menu file custom-menu" aria-labelledby="dropdownMenu2">
															<a  data-id="<?php echo $row['id'] ?>"   class="custom-menu-list file-option edit"><span><i class="fa fa-edit"></i> </span> Rename</a>
															<a  data-id="<?php echo $row['id'] ?>"   class="custom-menu-list file-option download"><span><i class="fa fa-download"></i> </span> Download</a>
															<a  data-id="<?php echo $row['id'] ?>"   class="custom-menu-list file-option delete"><span><i class="fa fa-trash"></i> </span> Delete</a>
															<a  data-id="<?php echo $row['id'] ?>"   class="custom-menu-list file-option share" data-toggle="modal" data-target="#userShare" ><span><i class="fa fa-solid fa-share"></i></span> Share</a>
														</div>
													</div>
												</div>
											</td>
											<td>
												<large><span><i class="fa <?php echo $icon ?>"></i></span><b class="to_file"> <?php echo $name ?></b></large>
												<input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">
												<hr>
											</td>
											<td>
												<i class="to_file"><?php echo date('Y/m/d h:i A',strtotime($row['date_updated'])) ?></i>
											</td>
											<td>
												<i class="to_file"><?php echo $row['description'] ?></i>
											</td>
										</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
							
						</div>
					</div>
					
				</div>
		<?php endif?>
		<!-- NORMAL FILES -->
		<?php if(!isset($_GET['q'])):?>
			<div>
				<div class="row">
					<div class="col-md-12"><h4><b>Folders</b></h4></div>
				</div>
				<hr>
				<div class="row">
					<?php 
					while($row=$folders->fetch_assoc()):
					?>
						<div class="card col-md-3 mt-2 ml-2 mr-2 mb-2 folder-item" data-id="<?php echo $row['id'] ?>">
							<div class="card-body">
									<large><span><i class="fa fa-folder"></i></span><b class="to_folder"> <?php echo $row['name'] ?></b></large>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-5"><h4><b>Recent</b></h4></div>
					<div class="col-md-7">
						<?php function get_setter(){
							$query = "";
							if(isset($_GET['q'])){
								$query = $query. "&q=".$_GET['q'];
							}
							return $query;
						}?>
						<div class="row" >
							<div class="col-1"><a  data-toggle="tooltip" data-placement="left" title="Reset Filter" href="index.php?page=files<?php get_setter()?>"><span><i class="fa-solid fa-arrow-rotate-right"></i></span></a></div>
							<div class="col-3"><span><a style="<?php echo isset($_GET["file_type"]) && $_GET["file_type"] == "docs" ? "color:#226dbd" : null?>" href="index.php?page=files&file_type=docs<?php get_setter()?>" class="active"><i class="fa-solid fa-file-lines"></i></span> Documents</a></div>
							<div class="col-3"><span><a style="<?php echo isset($_GET["file_type"]) && $_GET["file_type"] == "video" ? "color:#226dbd" : null?>" href="index.php?page=files&file_type=video<?php get_setter()?>"><i class="fa-solid fa-video"></i></i></span> Videos</a></div>
							<div class="col-3"><span><a style="<?php echo isset($_GET["file_type"]) && $_GET["file_type"] == "images" ? "color:#226dbd" : null?>" href="index.php?page=files&file_type=images<?php get_setter()?>"><i class="fa-solid fa-images"></i></span> Images </a></div>
							<div class="col-2"><span><a style="<?php echo isset($_GET["file_type"]) && $_GET["file_type"] == "others" ? "color:#226dbd" : null?>"href="index.php?page=files&file_type=others<?php get_setter()?>"><i class="fa-solid fa-folder"></i></span> Others</a></div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="card col-md-12">
						<div class="card-body">
							<table width="100%" class="table">
								<thead>
									<tr>
										<th span="1">Action</th>
										<th >Filename</th>
										<th class="">Date</th>
										<th class="">Description</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									while($row=$files->fetch_assoc()):
										$name = explode(' ||',$row['name']);
										$name = isset($name[1]) ? $name[0] ." (".$name[1].").".$row['file_type'] : $name[0] .".".$row['file_type'];
										$img_arr = array('png','jpg','jpeg','gif','psd','tif');
										$doc_arr =array('doc','docx');
										$pdf_arr =array('pdf','ps','eps','prn');
										$icon ='fa-file';
										if(in_array(strtolower($row['file_type']),$img_arr))
											$icon ='fa-image';
										if(in_array(strtolower($row['file_type']),$doc_arr))
											$icon ='fa-file-word';
										if(in_array(strtolower($row['file_type']),$pdf_arr))
											$icon ='fa-file-pdf';
										if(in_array(strtolower($row['file_type']),['xlsx','xls','xlsm','xlsb','xltm','xlt','xla','xlr']))
											$icon ='fa-file-excel';
										if(in_array(strtolower($row['file_type']),['zip','rar','tar']))
											$icon ='fa-file-archive';

									?>
										<tr class='file-item' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>">
											<td>
												<div>
													<div class="dropright">
														<button class="btn  dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<span><i class="fa fa-ellipsis-v" aria-hidden="true"></i>	</span>
														</button>
														<div class="dropdown-menu file custom-menu" aria-labelledby="dropdownMenu2">
															<a  data-id="<?php echo $row['id'] ?>"   class="custom-menu-list file-option edit"><span><i class="fa fa-edit"></i> </span> Rename</a>
															<a  data-id="<?php echo $row['id'] ?>"   class="custom-menu-list file-option download"><span><i class="fa fa-download"></i> </span> Download</a>
															<a  data-id="<?php echo $row['id'] ?>"   class="custom-menu-list file-option delete"><span><i class="fa fa-trash"></i> </span> Delete</a>
															<a  data-id="<?php echo $row['id'] ?>"   class="custom-menu-list file-option share" data-toggle="modal" data-target="#userShare" ><span><i class="fa fa-solid fa-share"></i></span> Share</a>
															<a  data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>"  class="custom-menu-list file-option copy-link"><i class="fa-solid fa-copy"></i> Copy Link</a>
														</div>
													</div>
												</div>
											</td>
											<td>
												<large><span><i class="fa <?php echo $icon ?>"></i></span><b class="to_file"> <?php echo $name ?></b></large>
												<input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">
												<hr>
											</td>
											<td>
												<i class="to_file"><?php echo date('Y/m/d h:i A',strtotime($row['date_updated'])) ?></i>
											</td>
											<td>
												<i class="to_file"><?php echo $row['description'] ?></i>
											</td>
										</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
							
						</div>
					</div>
					
				</div>
			</div>
		<?php endif?>
	</div>
</div>
<!-- <div id="menu-folder-clone" style="display: none;">
	<a href="javascript:void(0)" class="custom-menu-list file-option edit">Rename</a>
	<a href="javascript:void(0)" class="custom-menu-list file-option delete">Delete</a>
</div>
<div id="menu-file-clone">
		<a href="javascript:void(0)"  class="custom-menu-list file-option edit"><span><i class="fa fa-edit"></i> </span> Rename</a>
		<a href="javascript:void(0)"  class="custom-menu-list file-option download"><span><i class="fa fa-download"></i> </span> Download</a>
		<a href="javascript:void(0)"  class="custom-menu-list file-option delete"><span><i class="fa fa-trash"></i> </span> Delete</a>
		<a href="javascript:void(0)"  class="custom-menu-list file-option share" data-toggle="modal" data-target="#userShare" ><span><i class="fa fa-solid fa-share"></i></span> Share</a>
	</div> -->


<!-- User Share Modal -->
<div class="modal fade" id="userShare" tabindex="-1" role="dialog" aria-labelledby="userShareLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
	  <div class="modal-header">
			<h5 class="modal-title">Select User to Share File</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form action="ajax.php" method="post" id="save-share-form" >
			<div class="modal-body">
				<input type="hidden" name="file_id" id="fileId">
				<input type="hidden" name="action" value="save_shared">
				<div class="row">
					<div class="col-md-12">
						<select class="js-example-basic-multiple" name="users[]" multiple="multiple" width="100%">
							<!-- <?php #if(!empty($users)): ?>
								<?php #foreach($users as $user): ?>
									<option value="<?php #echo $user['id']?>"> <?php #echo $user['username']?></option>
								<?php #endforeach?>
							<?php #endif ?> -->
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" id="share-to-all">Share to all</button>
				<button type="submit" class="btn btn-primary">Share File</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			</div>
		</form>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="link-placeholder">
<div id="menu-folder-clone" style="display: none;">
	<a href="javascript:void(0)" class="custom-menu-list file-option edit">Rename</a>
	<a href="javascript:void(0)" class="custom-menu-list file-option delete">Delete</a>
</div>


<script>
	
	$('#new_folder').click(function(){
		uni_modal('','manage_folder.php?fid=<?php echo $folder_parent ?>')
	})
	$('#new_file').click(function(){
		uni_modal('','manage_files.php?fid=<?php echo $folder_parent ?>')
	})
	$('.folder-item').dblclick(function(){
		location.href = 'index.php?page=files&fid='+$(this).attr('data-id')
	})
	$('.folder-item').bind("contextmenu", function(event) { 
			event.preventDefault();
			$("div.custom-menu").hide();
			var custom =$("<div class='custom-menu'></div>")
				custom.append($('#menu-folder-clone').html())
				custom.find('.edit').attr('data-id',$(this).attr('data-id'))
				custom.find('.delete').attr('data-id',$(this).attr('data-id'))
			custom.appendTo("body")
			custom.css({top: event.pageY + "px", left: event.pageX + "px"});

			$("div.custom-menu .edit").click(function(e){
				e.preventDefault()
				uni_modal('Rename Folder','manage_folder.php?fid=<?php echo $folder_parent ?>&id='+$(this).attr('data-id') )
			})
			$("div.custom-menu .delete").click(function(e){
				e.preventDefault()
				_conf("All files in the folder will also be deleted. Are you sure to delete this Folder?",'delete_folder',[$(this).attr('data-id')])
			})
		})




	$("div.file.custom-menu .edit").click(function(e){
		e.preventDefault()
		$('.rename_file[data-id="'+$(this).attr('data-id')+'"]').siblings('large').hide();
		$('.rename_file[data-id="'+$(this).attr('data-id')+'"]').show();
	})
	$("div.file.custom-menu .delete").click(function(e){
		e.preventDefault()
		_conf("Are you sure to delete this file?",'delete_file',[$(this).attr('data-id')])
	})
	$("div.file.custom-menu .download").click(function(e){
		e.preventDefault()
		window.open('download.php?id='+$(this).attr('data-id'))
	})

	$('.rename_file').keypress(function(e){
		var _this = $(this)
		if(e.which == 13){
			start_load()
			$.ajax({
				url:'ajax.php?action=file_rename',
				method:'POST',
				data:{id:$(this).attr('data-id'),name:$(this).val(),type:$(this).attr('data-type'),folder_id:'<?php echo $folder_parent ?>'},
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp);
						if(resp.status== 1){
								_this.siblings('large').find('b').html(resp.new_name);
								end_load();
								_this.hide()
								_this.siblings('large').show()
						}
					}
				}
			})
		}
	})

	$(document).ready(function(){
		$('#search').keyup(function(){
			var _f = $(this).val().toLowerCase()
			$('.to_folder').each(function(){
				var val  = $(this).text().toLowerCase()
				if(val.includes(_f))
					$(this).closest('.card').toggle(true);
					else
					$(this).closest('.card').toggle(false);

				
			})
			$('.to_file').each(function(){
				var val  = $(this).text().toLowerCase()
				if(val.includes(_f))
					$(this).closest('tr').toggle(true);
					else
					$(this).closest('tr').toggle(false);

				
			})
		})
	})
	function delete_folder($id){
		start_load();
		$.ajax({
			url:'ajax.php?action=delete_folder',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp == 1){
					alert_toast("Folder successfully deleted.",'success')
						setTimeout(function(){
							location.reload()
						},1500)
				}
			}
		})
	}
	function delete_file($id){
		start_load();
		$.ajax({
			url:'ajax.php?action=delete_file',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp == 1){
					alert_toast("Folder successfully deleted.",'success')
						setTimeout(function(){
							location.reload()
						},1500)
				}
			}
		})
	}

const file ={
	init: function(){
		this.share()
		this.select2()
		this.saveShare()
		this.shareToAll()
		this.copyLink()
		
	},
	share: function() {
		$(document).on('click', '.custom-menu-list.file-option.share', function(){
			$('#userShare').find('#fileId').val($(this).data('id'));
			$('#share-to-all').attr('data-id', $(this).data('id'))
		});
	},
	select2: function(){
		$(document).ready(function() {
			$('.js-example-basic-multiple').select2({
				ajax: {
					url: 'http://localhost/system/fms/ajax.php?action=get_users',
					dataType: 'json',
					processResults: function (data) {
						console.log(data);
						return {
							results: data	
						};
					}
				}
			});
		});
	},
	shareToAll : function(){
		$(document).on('click', '#share-to-all', function(){
			let $this= $(this)
			$id =$this.attr('data-id');
			$this.attr('disable', 1).text('Sharing.....')
			console.log($id)
			$.ajax({
				url:'ajax.php?action=share_to_all',
				method:'POST',
				data:{file_id:$id},
				dataType: 'json',
				success:function(resp){
					console.log(resp)
					if(resp.is_valid == 1){
						alert_toast("File successfully shared.",'success')
							setTimeout(function(){
								location.reload()
							},1500)
					}
					
				}
			})
		})
	},
	saveShare: function(){
		$('#save-share-form').on('submit', function(e){
			e.preventDefault()
			start_load();
			$.ajax({
				url: $(this).attr('action'),
				method:'POST',
				data: $(this).serializeArray() ,
				dataType: 'json',
				success:function(resp){
					console.log(resp)
					if(resp.is_valid == 1){
						alert_toast("File successfully shared!.",'success')
							setTimeout(function(){
								location.reload()
							},1500)
					}
				}
			})
		})
	},
	copyLink: function(){
		$('.copy-link').on('click', function(e){
			e.preventDefault()
			let $this= $(this)
			let id = $this.data('id');
			let name = $this.data('name');
			$('#link-placeholder').val(`<a href="http://localhost/system/fms/index.php?page=shared_docss&file_id=${id}" target="_blank">${name}</a>`)
			 /* Get the text field */
			 var copyText = document.getElementById("link-placeholder");

			/* Select the text field */
			copyText.select();

			/* Copy the text inside the text field */
			navigator.clipboard.writeText(copyText.value);
			alert_toast("Link Copied!.",'success')
		})
		
	}
} 
file.init();


</script>