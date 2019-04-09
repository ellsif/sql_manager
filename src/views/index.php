<?php
// 管理画面
$settings = $settings ?? [];
$error = $error ?? null;
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=yes">
    <meta name="format-detection" content="telephone=no,address=no,email=no">
    <title>SQL Manager</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-4 mb-4">SQL Settings</h1>
		<?php if ($error) : ?>
			<?php echo $error ?>
		<?php endif ?>
        <table class="table">
            <thead>
            <tr>
                <th>NAME</th>
                <th>Label</th>
                <th>SQL</th>
                <th>Note</th>
                <th class="text-center">action</th>
            </tr>
            </thead>
            <tbody class="sql-settings">
                <?php foreach($settings as $setting) : ?>
                <tr>
                    <td class="sql-name" style="max-width:250px;"><?php echo $setting['name'] ?></td>
                    <td class="sql-label" style="max-width:250px;"><?php echo $setting['label'] ?></td>
                    <td class="sql-sql" style="max-width:300px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;"><?php echo $setting['sql'] ?></td>
                    <td class="sql-note" style="max-width:250px;font-size:0.75rem;"><?php echo $setting['note'] ?></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-primary js-edit" data-name="<?php echo $setting['name'] ?>">Edit</button>
                        <button type="button" class="btn btn-danger js-delete" data-name="<?php echo $setting['name'] ?>">Delete</button>
                    </td>
                </tr>
                <? endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="fixed-top pt-4">
        <div class="container text-right">
            <button type="button" class="btn btn-primary js-add">Add</button>
			<form class="d-inline-block" method="post">
				<input id="postSettings" type="hidden" name="settings">
				<button type="button" class="btn btn-primary js-save">Save</button>
			</form>
        </div>
    </div>

    <div id="add-modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add SQL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addSql">
                        <div class="form-group">
                            <label for="sqlName">NAME</label>
                            <input type="text" class="form-control" id="sqlNameAdd">
                        </div>
                        <div class="form-group">
                            <label for="sqlLabel">Label</label>
                            <input type="text" class="form-control" id="sqlLabelAdd">
                        </div>
                        <div class="form-group">
                            <label for="sqlSql">SQL</label>
                            <textarea class="form-control" id="sqlSqlAdd" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="sqlNote">Note</label>
                            <textarea class="form-control" id="sqlNoteAdd" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary js-add-execute">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div id="edit-modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit SQL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editSql">
                        <div class="form-group">
                            <label for="sqlName">NAME</label>
                            <input type="text" class="form-control" id="sqlName">
                        </div>
                        <div class="form-group">
                            <label for="sqlLabel">Label</label>
                            <input type="text" class="form-control" id="sqlLabel">
                        </div>
                        <div class="form-group">
                            <label for="sqlSql">SQL</label>
                            <textarea class="form-control" id="sqlSql" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="sqlNote">Note</label>
                            <textarea class="form-control" id="sqlNote" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary js-edit-execute">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div id="delete-modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">DELETE SQL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this SQL?</p>
                    <div class="card">
                        <pre class="card-body"><code id="delPreview"></code></pre>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger js-delete-execute">Delete</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var sqlManager = sqlManager || {};
    sqlManager.settings = <?php echo json_encode($settings) ?>;
    sqlManager.editElem = null;
    sqlManager.deleteElem = null;
    sqlManager.saveSettings = function(){
		$('#postSettings').val(JSON.stringify(sqlManager.settings));
	};
    sqlManager.onClickAdd = function(){
        $('#sqlNameAdd').val('');
        $('#sqlLabelAdd').val('');
        $('#sqlSqlAdd').val('');
        $('#sqlNoteAdd').val('');
        $('#add-modal').modal();
    };
    sqlManager.onClickEdit = function() {
        var idx;
        var name = $(this).data('name');
        for (idx in sqlManager.settings) {
            var setting = sqlManager.settings[idx];
            if (setting['name'] === name) {
                $('#sqlName').val(setting['name']);
                $('#sqlLabel').val(setting['label']);
                $('#sqlSql').val(setting['sql']);
                $('#sqlNote').val(setting['note']);
                sqlManager.editElem = $(this);
                $('#edit-modal').modal();
                break;
            }
        }
    };
    sqlManager.onClickDelete = function() {
        var idx;
        var name = $(this).data('name');
        for (idx in sqlManager.settings) {
            var setting = sqlManager.settings[idx];
            if (setting['name'] === name) {
                $('#delPreview').text(setting['sql']);
                sqlManager.deleteElem = $(this);
                $('#delete-modal').modal();
                break;
            }
        }
    };
    $(function(){
        $('.js-save').on('click', function(e) {
            sqlManager.saveSettings();
			$(this).closest('form').get(0).submit();
			return true;
        });
        $('.js-add').on('click', sqlManager.onClickAdd);
        $('.js-add-execute').on('click', function(){
            var name = $('#sqlNameAdd').val();
            var label = $('#sqlLabelAdd').val();
            var sql = $('#sqlSqlAdd').val();
            var note = $('#sqlNoteAdd').val();
            var idx;
            for (idx in sqlManager.settings) {
                var setting = sqlManager.settings[idx];
                if (setting['name'] === name) {
                    alert('name ' + name + ' is duplicated');
                    return;
                } else if (setting['label'] === label) {
                    alert('label ' + label + ' is duplicated');
                    return;
				}
            }
            sqlManager.settings.push({
                name: name,
                label: label,
                sql: sql,
                note: note
            });
            var trElem = $('<tr></tr>');
            var nameElem = $('<td class="sql-name" style="max-width:250px;"></td>');
            nameElem.text(name);
            var labelElem = $('<td class="sql-label" style="max-width:250px;"></td>');
            labelElem.text(label);
            var sqlElem = $('<td class="sql-sql" style="max-width:300px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;"></td>');
            sqlElem.text(sql);
            var noteElem = $('<td class="sql-note" style="max-width:250px;font-size:0.75rem;"></td>');
            noteElem.text(note);
            var actionElem = $('<td class="text-center"><button type="button" class="btn btn-primary js-edit">Edit</button> <button type="button" class="btn btn-danger js-delete">Delete</button></td>');
            actionElem.find('button').data('name', name);
            actionElem.find('.js-edit').on('click', sqlManager.onClickEdit);
            actionElem.find('.js-delete').on('click', sqlManager.onClickDelete);
            trElem.append([nameElem, labelElem, sqlElem, noteElem, actionElem]);
            $('.sql-settings').append(trElem);
            $('#add-modal').modal('hide');
        });
        $('.js-edit').on('click', sqlManager.onClickEdit);
        $('.js-edit-execute').on('click', function(){
            var idx;
            var name = sqlManager.editElem.data('name');
            var trElem = sqlManager.editElem.closest('tr');
            for (idx in sqlManager.settings) {
                var setting = sqlManager.settings[idx];
                if (setting['name'] === name) {
                    trElem.find('.sql-name').text($('#sqlName').val());
                    trElem.find('.sql-label').text($('#sqlLabel').val());
                    trElem.find('.sql-sql').text($('#sqlSql').val());
                    trElem.find('.sql-note').text($('#sqlNote').val());
                    trElem.find('.js-delete').data('name', $('#sqlName').val());
                    sqlManager.editElem.data('name', $('#sqlName').val());
                    sqlManager.settings[idx]['name'] = $('#sqlName').val();
                    sqlManager.settings[idx]['label'] = $('#sqlLabel').val();
                    sqlManager.settings[idx]['sql'] = $('#sqlSql').val();
                    sqlManager.settings[idx]['note'] = $('#sqlNote').val();
                    break;
                }
            }
            $('#edit-modal').modal('hide');
        });
        $('.js-delete').on('click', sqlManager.onClickDelete);
        $('.js-delete-execute').on('click', function(){
            var idx;
            var name = sqlManager.deleteElem.data('name');
            for (idx in sqlManager.settings) {
                var setting = sqlManager.settings[idx];
                if (setting['name'] === name) {
                    sqlManager.settings.splice(idx, 1);
                    sqlManager.deleteElem.closest('tr').remove();
                    break;
                }
            }
            $('#delete-modal').modal('hide');
        });
    });
</script>
</html>

