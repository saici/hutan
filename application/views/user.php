<?php
	$message = get_flash_message();
	$array_user = $this->User_model->get_array(array( 'limit' => 1000 ));
	$array_user_type = $this->User_Type_model->get_array(array( 'sort' => '[{"property":"id","direction":"ASC"}]', 'limit' => 1000 ));
	
	// page
	$page = array();
	if (!empty($message)) {
		$page['message'] = $message;
	}
?>
<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<?php $this->load->view( 'panel/common/header' ); ?>

<div id="cnt-content"><div class="container"><div class="cnt-normal">
	<h3 class="main-title">User</h3>
	<div class="hide">
		<div class="cnt-data"><?php echo json_encode($page); ?></div>
	</div>
	
	<div class="cnt-table">
		<div class="table">
			<table cellpadding="0" cellspacing="0" border="1" class="display datatable">
				<thead>
					<tr>
						<th>Account</th>
						<th>Email</th>
						<th>Nama Lengkap</th>
						<th>Jenis User</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($array_user as $key => $row) { ?>
					<?php if (isset($row['passwd'])) { ?>
						<?php unset($row['passwd']); ?>
					<?php } ?>
					
					<tr class="<?php echo (($key % 2) == 0) ? 'even' : 'odd'; ?> gradeA">
						<td><?php echo $row['alias']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['fullname']; ?></td>
						<td><?php echo $row['user_type_name']; ?></td>
						<td class="center">
							<i class="fa fa-pencil btn-edit"></i>
							<i class="fa fa-times btn-delete"></i>
							<span class="hide"><?php echo json_encode($row); ?></span>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	
	<div class="form-box hide"><form id="form-editor">
		<input type="hidden" name="id" value="0" />
		<input type="hidden" name="action" value="update" />
		
		<div class="label">Account</div>
		<div class="input">
			<input type="text" name="alias" class="short" />
		</div>
		<div class="clear"></div>
		<div class="label">Email</div>
		<div class="input">
			<input type="text" name="email" class="short" />
		</div>
		<div class="clear"></div>
		<div class="label">Nama Lengkap</div>
		<div class="input">
			<input type="text" name="fullname" class="short" />
		</div>
		<div class="clear"></div>
		<div class="label">Jenis User</div>
		<div class="input">
			<select name="user_type_id" class="short">
				<?php echo ShowOption(array( 'Array' => $array_user_type, 'ArrayTitle' => 'name' )); ?>
			</select>
		</div>
		<div class="clear"></div>
		<div class="label">Password</div>
		<div class="input">
			<input type="password" name="passwd" class="short" />
		</div>
		<div class="clear"></div>
		<div class="label">&nbsp;</div>
		<div class="input">
			<button type="button" class="btn-cancel"><i class="fa fa-mail-reply"></i> Batal</button>
			<button type="submit" class="btn-submit"><i class="fa fa-save"></i> Simpan</button>
		</div>
		<div class="clear"></div>
	</form></div>
</div></div></div>

<script type="text/javascript">
$(document).ready(function() {
	var page = {
		init: function() {
			var raw_data = $('.cnt-data').text();
			eval('var data = ' + raw_data);
			page.data = data;
		},
		show_form: function() {
			$('.cnt-table').hide();
			$('.form-box').show();
		},
		show_grid: function() {
			$('.cnt-table').show();
			$('.form-box').hide();
		}
	}
	page.init();
	
	// datatable
	$('.btn-edit').click(function() {
		var raw_record = $(this).parent('td').find('.hide').text();
		eval('var record = ' + raw_record);
		Func.populate({ cnt: '#form-editor', record: record });
		page.show_form();
	});
	$('.btn-delete').click(function() {
		var raw_record = $(this).parent('td').find('.hide').text();
		eval('var record = ' + raw_record);
		Func.form.delete({
			url: web.host + 'user/action',
			param: { action: 'delete', id: record.id },
			callback: function(result) {
				if (result.status) {
					window.location = window.location.href;
				}
			}
		});
	});
	
	// form
	$('#form-editor').validate({
		rules: {
			alias: { required: true },
			fullname: { required: true, minlength: 5 },
			email: { required: true, email: true },
			user_type_id: { required: true },
			passwd: { required: true }
		}
	});
	$('#form-editor').submit(function(e) {
		e.preventDefault();
		if (! $('#form-editor').valid()) {
			return false;
		}
		
		Func.form.submit({
			url: web.host + 'user/action',
			param: Func.form.get_galue('form-editor'),
			callback: function(result) {
				if (result.status) {
					window.location = window.location.href;
				}
			}
		});
	});
	
	// helper
	$('.dataTables_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn show-form">Tambah</button></div>');
	$('.show-form').click(function() {
		$('#form-editor')[0].reset();
		$('#form-editor [name="id"]').val(0);
		
		page.show_form();
	});
	$('.btn-cancel').click(function() {
		page.show_grid();
	});
} );
</script>

<?php $this->load->view( 'panel/common/footer' ); ?>
</body>