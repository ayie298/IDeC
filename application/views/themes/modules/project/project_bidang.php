<script>
    $(function(){
       $("#bar_rms").click();
        
        showGrid();
        
        $('.unit').change(function(){
            $.ajax({
                url : '<?php echo site_url('project/bidang') ?>',
                type : 'POST',
                data : $('#form-unit form').serialize(),
                success : function() {
                    showGrid();
                }
            });

            return false;
        });

        $('.unitYear').change(function(){
            $.ajax({
                url : '<?php echo site_url('project/bidang') ?>',
                type : 'POST',
                data : $('#form-unit form').serialize(),
                success : function() {
                    showGrid();
                }
            });

            return false;
        })
    });

    function showGrid()
    {
        var source = {
            datatype: "json",
            type    : "POST",
            datafields: [
            { name: 'urut'},
            { name: 'id', type: 'number'},
            { name: 'parent', type: 'number'},
            { name: 'nik', type: 'string'},
            { name: 'researcher', type: 'string'},
            { name: 'title', type: 'string'},
            { name: 'project', type: 'string'},
            { name: 'owner', type: 'string'}
        ],
            hierarchy:
            {
                keyDataField: { name: 'id' },
                parentDataField: { name: 'parent' }
            },
            id: 'id',
            root: 'Rows',
            url: "<?php echo site_url('project/bidang/bidang_json'); ?>",
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
                source: dataadapter,
                sortable: false, columnsResize: true,
                ready: function()
                {
                    $("#treeGrid").jqxTreeGrid('expandRow', '1');
                    $("#treeGrid").jqxTreeGrid('expandRow', '2');
                    $("#treeGrid").jqxTreeGrid('expandRow', '3');
                },
                columns: [
                { text: 'Researcher', datafield: 'researcher', width: '22%' },
                { text: 'Title', datafield: 'title', width: '24%' },
                { text: 'NIK', datafield: 'nik', width: '8%' },
                { text: 'Project Owner', datafield: 'owner', width: '20%' },
                { text: 'Project Title', datafield: 'project', width: '25%' }
                ]
            });
    }

</script>

<div class="row-fluid">
   <div class="span12">
       <h3 class="page-title">
         BKO Researcher per Bidang
       </h3>
   </div>
</div>
<div id="popup" style="display:none"><div id="popup_title">Researcher Map</div><div id="popup_content">{popup}</div></div>
<div>
    <div style="width:99%;background-color:#EEEEEE;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        <div id="form-unit" style="float:right;position:relative;width:600px;padding-right:10px;height:40px;text-align:right">
            <?php echo form_open() ?>
            <select size="1" class="input unit" name="unit" style="width:300px;margin-top:8px;">
                <option value="">Choose Unit</option>
                <?php foreach($unit as $unit) : ?>
                    <option value="<?php echo $unit->id_organization_item ?>"><?php echo $unit->org_name ?></option>
                <?php endforeach ?>
            </select>
            <select size="1" class="input unitYear" name="year" style="width:100px;margin-top:8px;">
                <option value="">Choose Year</option>
                <?php for($i=date('Y');$i>=date('Y')-5;$i--) : ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php endfor; ?>
            </select>
            </form>
        </div>
        <div style="clear:both"></div>
    </div>
    <div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        <div id="treeGrid"></div>
    </div>
</div>
<br>
