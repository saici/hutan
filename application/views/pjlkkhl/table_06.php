<?php
	// user
	$user = $this->User_model->get_session();
	
	// record data
	$array_record = $this->$module['model_name']->get_array(array( 'user_type_id' => $user['user_type_id'] ));
	$message = get_flash_message();
	
	// page
	$page['module'] = $module;
	if (!empty($message)) {
		$page['message'] = $message;
	}
?>
<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<?php $this->load->view( 'panel/common/header' ); ?>

<style>
.form-box .label { width: 300px; }
.form-box .input { width: 260px; }
</style>

<div id="cnt-content"><div class="container"><div class="cnt-normal">
	<h3 class="main-title" style="padding: 0px;"><?php echo $module['module_type_name']; ?></h3>
	<h3 class="main-title"><?php echo $module['content']; ?></h3>
	<div class="hide">
		<div class="cnt-data"><?php echo json_encode($page); ?></div>
	</div>
	
	<div class="table">
		<table cellpadding="0" cellspacing="0" border="1" class="display datatable">
			<thead>
				<tr>
					<th colspan="2">Penelitian dan Pengembangan</th>
					<th colspan="2">Pendidikan / Ilmu Pengetahuan</th>
					<th colspan="2">Rekreasi</th>
					<th colspan="2">Berkemah</th>
					<th colspan="2">Lain-Lain</th>
					<th colspan="3">Jumlah</th>
					<th rowspan="2">Dari</th>
					<th rowspan="2">&nbsp;</th>
				</tr>
				<tr>
					<th>DN</th>
					<th>LN</th>
					<th>DN</th>
					<th>LN</th>
					<th>DN</th>
					<th>LN</th>
					<th>DN</th>
					<th>LN</th>
					<th>DN</th>
					<th>LN</th>
					<th>DN</th>
					<th>LN</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($array_record as $key => $row) { ?>
				<tr class="<?php echo (($key % 2) == 0) ? 'even' : 'odd'; ?> gradeA">
					<td class="center"><?php echo $row['penelitian_dn']; ?></td>
					<td class="center"><?php echo $row['penelitian_ln']; ?></td>
					<td class="center"><?php echo $row['pendidikan_dn']; ?></td>
					<td class="center"><?php echo $row['pendidikan_ln']; ?></td>
					<td class="center"><?php echo $row['rekreasi_dn']; ?></td>
					<td class="center"><?php echo $row['rekreasi_ln']; ?></td>
					<td class="center"><?php echo $row['berkemah_dn']; ?></td>
					<td class="center"><?php echo $row['berkemah_ln']; ?></td>
					<td class="center"><?php echo $row['lain_dn']; ?></td>
					<td class="center"><?php echo $row['lain_ln']; ?></td>
					<td class="center"><?php echo $row['total_dn']; ?></td>
					<td class="center"><?php echo $row['total_ln']; ?></td>
					<td class="center"><?php echo $row['total']; ?></td>
					<td><?php echo $row['user_type_name']; ?></td>
					<td class="center">
						<i class="fa fa-pencil btn-edit"></i>
						<i class="fa fa-mail-forward btn-forward"></i>
						<i class="fa fa-times btn-delete"></i>
						<span class="hide"><?php echo json_encode($row); ?></span>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	
	<div class="form-box hide"><form id="form-editor">
		<input type="hidden" name="id" value="0" />
		<input type="hidden" name="action" value="update" />
		
		<div class="label">Penelitian dan Pengembangan DN</div>
		<div class="input"><input type="text" name="penelitian_dn" class="short" /></div>
		<div class="clear"></div>
		<div class="label">Penelitian dan Pengembangan LN</div>
		<div class="input"><input type="text" name="penelitian_ln" class="short" /></div>
		<div class="clear"></div>
		<div class="label">Pendidikan / Ilmu Pengetahuan DN</div>
		<div class="input"><input type="text" name="pendidikan_dn" class="short" /></div>
		<div class="clear"></div>
		<div class="label">Pendidikan / Ilmu Pengetahuan LN</div>
		<div class="input"><input type="text" name="pendidikan_ln" class="short" /></div>
		<div class="clear"></div>
		<div class="label">Rekreasi DN</div>
		<div class="input"><input type="text" name="rekreasi_dn" class="short" /></div>
		<div class="clear"></div>
		<div class="label">Rekreasi LN</div>
		<div class="input"><input type="text" name="rekreasi_ln" class="short" /></div>
		<div class="clear"></div>
		<div class="label">Berkemah DN</div>
		<div class="input"><input type="text" name="berkemah_dn" class="short" /></div>
		<div class="clear"></div>
		<div class="label">Berkemah LN</div>
		<div class="input"><input type="text" name="berkemah_ln" class="short" /></div>
		<div class="clear"></div>
		<div class="label">Lain-Lain DN</div>
		<div class="input"><input type="text" name="lain_dn" class="short" /></div>
		<div class="clear"></div>
		<div class="label">Lain-Lain DN</div>
		<div class="input"><input type="text" name="lain_ln" class="short" /></div>
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
			$('.table').hide();
			$('.form-box').show();
		},
		show_grid: function() {
			$('.table').show();
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
	$('.btn-forward').click(function() {
		var raw_record = $(this).parent('td').find('.hide').text();
		eval('var record = ' + raw_record);
		
		Func.form.submit({
			url: page.data.module.module_link + '/action',
			param: { action: 'forward', id: record.id },
			callback: function(result) {
				if (result.status) {
					window.location = window.location.href;
				}
			}
		});
	});
	$('.btn-delete').click(function() {
		var raw_record = $(this).parent('td').find('.hide').text();
		eval('var record = ' + raw_record);
		Func.form.delete({
			url: page.data.module.module_link + '/action',
			param: { action: 'delete', id: record.id },
			callback: function(result) {
				if (result.status) {
					window.location = window.location.href;
				}
			}
		});
	});
	
	// form
	$('#form-editor').validate({ });
	$('#form-editor').submit(function(e) {
		e.preventDefault();
		if (! $('#form-editor').valid()) {
			return false;
		}
		
		Func.form.submit({
			url: page.data.module.module_link + '/action',
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