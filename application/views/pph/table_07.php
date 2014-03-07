<?php
	// master
	$array_satuan = get_array_satuan_hutan();
	
	// record data
	$array_record = $this->$module['model_name']->get_array();
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

<div id="cnt-content"><div class="container"><div class="cnt-normal">
	<h3 class="main-title"><?php echo $module['content']; ?></h3>
	<div class="hide">
		<div class="cnt-data"><?php echo json_encode($page); ?></div>
	</div>
	
	<div class="table">
		<table cellpadding="0" cellspacing="0" border="1" class="display datatable">
			<thead>
				<tr>
					<th colspan="6">Hasil Pengamanan</th>
					<th rowspan="3">Jumlah Kasus</th>
					<th rowspan="3">Keterangan</th>
					<th rowspan="3">&nbsp;</th>
				</tr>
				<tr>
					<th colspan="3">Temuan</th>
					<th colspan="3">Sitaan</th>
				</tr>
				<tr>
					<th>Tumbuhan</th>
					<th>Satwa Liar</th>
					<th>Barang Bukti</th>
					<th>Tumbuhan</th>
					<th>Satwa Liar</th>
					<th>Barang Bukti</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($array_record as $key => $row) { ?>
				<tr class="<?php echo (($key % 2) == 0) ? 'even' : 'odd'; ?> gradeA">
					<td class="center"><?php echo $row['temuan_tumbuhan']; ?></td>
					<td class="center"><?php echo $row['temuan_satwa']; ?></td>
					<td><?php echo $row['temuan_bukti']; ?></td>
					<td class="center"><?php echo $row['sitaan_tumbuhan']; ?></td>
					<td class="center"><?php echo $row['sitaan_satwa']; ?></td>
					<td><?php echo $row['sitaan_bukti']; ?></td>
					<td class="center"><?php echo $row['jumlah_kasus']; ?></td>
					<td><?php echo $row['keterangan']; ?></td>
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
	
	<div class="form-box hide"><form id="form-editor">
		<input type="hidden" name="id" value="0" />
		<input type="hidden" name="action" value="update" />
		
		<div class="label">Temuan</div>
		<div class="clear"></div>
		<div class="label">- Tumbuhan</div>
		<div class="input"><input type="text" name="temuan_tumbuhan" class="short" /></div>
		<div class="clear"></div>
		<div class="label">- Satwa Liar</div>
		<div class="input"><input type="text" name="temuan_satwa" class="short" /></div>
		<div class="clear"></div>
		<div class="label">- Barang bukti lainnya</div>
		<div class="input"><input type="text" name="temuan_bukti" class="long" /></div>
		<div class="clear"></div>
		
		<div class="label">Sitaan</div>
		<div class="clear"></div>
		<div class="label">- Tumbuhan</div>
		<div class="input"><input type="text" name="sitaan_tumbuhan" class="short" /></div>
		<div class="clear"></div>
		<div class="label">- Satwa Liar</div>
		<div class="input"><input type="text" name="sitaan_satwa" class="short" /></div>
		<div class="clear"></div>
		<div class="label">- Barang bukti lainnya</div>
		<div class="input"><input type="text" name="sitaan_bukti" class="long" /></div>
		<div class="clear"></div>
		
		<div class="label">Jumlah Kasus</div>
		<div class="input"><input type="text" name="jumlah_kasus" class="short" /></div>
		<div class="clear"></div>
		<div class="label">Keterangan</div>
		<div class="input"><textarea name="keterangan" class="long"></textarea></div>
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