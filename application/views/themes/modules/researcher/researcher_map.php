<script>
	$(function(){
       $("#bar_rms").click();
        
		var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number'},
			{ name: 'parent', type: 'number'},
			{ name: 'bidang', type: 'string'},
			{ name: 'lab', type: 'string'},
			{ name: 'program', type: 'string'},
			<?php $no=1 ?>
			<?php foreach($researcher as $rs) : ?>
			{ name: 'r<?php echo $no ?>', type: 'number'},
			<?php $no++ ?>
			<?php endforeach ?>
        ],
			hierarchy:
			{
				keyDataField: { name: 'id' },
				parentDataField: { name: 'parent' }
			},
			id: 'id',
			root: 'Rows',
			url: "<?php echo site_url('project/bko/bko_json'); ?>",
			cache: false
		};
     
		var dataadapter = new $.jqx.dataAdapter(source, {
			loadError: function(xhr, status, error){
				alert(error);
			}
		});

		$("#treeGrid").jqxTreeGrid(
            {
                width: '99%',
                source: dataadapter,columnsHeight: 280,
                sortable: false, columnsResize: true,
                ready: function()
                {
                    $("#treeGrid").jqxTreeGrid('expandRow', '1');
                    $("#treeGrid").jqxTreeGrid('expandRow', '2');
                    $("#treeGrid").jqxTreeGrid('expandRow', '3');
                },
                columns: [
				{ text: 'Bidang', datafield: 'bidang', width: '5%' },
				{ text: 'Lab', datafield: 'lab', width: '8%' },
				{ text: 'Program', datafield: 'program', width: '20%' },
				<?php $no = 1 ?>
				<?php foreach($researcher as $rs) : ?>
				{ text: "<div style='position:absolute;width:30px;height:190px;float:left;margin-top:-40px'><div style='transform: rotate(270deg);text-align:left;margin:80px 0 0 -85px;width:180px;padding:5px'><?php echo $rs->name ?></div></div>", datafield: 'r<?php echo $no ?>', width: '2%' },
				<?php $no++ ?>
				<?php endforeach ?>
				]
            });

	});

</script>

<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 BKO Researcher
	   </h3>
   </div>
</div>
<div id="popup" style="display:none"><div id="popup_title">Researcher Map</div><div id="popup_content">{popup}</div></div>
<div>
	<div style="width:99%;background-color:#EEEEEE;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div style="float:right;position:relative;width:600px;padding-right:10px;height:40px;text-align:right">
			<select size="1" class="input" name="gendre" style="width:100px;margin-top:8px;">
				<option>2014</option>
				<option>2015</option>
			</select>
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        <div id="treeGrid"></div>
	</div>
</div>
<br>
