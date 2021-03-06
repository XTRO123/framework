<section class="content-header">
    <h1><?= __d('users', 'Roles'); ?></h1>
    <ol class="breadcrumb">
        <li><a href='<?= site_url('admin/dashboard'); ?>'><i class="fa fa-dashboard"></i> <?= __d('users', 'Dashboard'); ?></a></li>
        <li><?= __d('users', 'Roles'); ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

<?= Session::getMessages(); ?>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title"><?= __d('users', 'Registered Roles'); ?></h3>
        <div class="box-tools">
        <?= $roles->links(); ?>
        </div>
    </div>
    <div class="box-body no-padding">
<?php if (! $roles->isEmpty()) { ?>
        <table id='left' class='table table-striped table-hover responsive'>
            <tr class="bg-navy disabled">
                <th style='text-align: center; vertical-align: middle;'><?= __d('users', 'ID'); ?></th>
                <th style='text-align: center; vertical-align: middle;'><?= __d('users', 'Name'); ?></th>
                <th style='text-align: center; vertical-align: middle;'><?= __d('users', 'Slug'); ?></th>
                <th style='text-align: center; vertical-align: middle;'><?= __d('users', 'Description'); ?></th>
                <th style='text-align: center; vertical-align: middle;'><?= __d('users', 'Users'); ?></th>
                <th style='text-align: right; vertical-align: middle;'><?= __d('users', 'Operations'); ?></th>
            </tr>
<?php
    foreach ($roles->getItems() as $role) {
        echo "
<tr>
    <td style='text-align: center; vertical-align: middle;' width='5%'>" .$role->id ."</td>
    <td style='text-align: center; vertical-align: middle;' width='17%'>" .$role->name ."</td>
    <td style='text-align: center; vertical-align: middle;' width='17%'>" .$role->slug ."</td>
    <td style='text-align: left; vertical-align: middle;' width='40%'>" .$role->description ."</td>
    <td style='text-align: center; vertical-align: middle;' width='6%'>" .$role->users->count() ."</td>
    <td style='text-align: right; vertical-align: middle;' width='15%'>
        <div class='btn-group' role='group' aria-label='...'>
            <a class='btn btn-sm btn-warning' href='" .site_url('admin/roles/' .$role->id). "' title='". __d('users', 'Show the Details') ."' role='button'><i class='fa fa-search'></i></a>
            <a class='btn btn-sm btn-success' href='" .site_url('admin/roles/' .$role->id .'/edit') ."' title='" .__d('users', 'Edit this Role') ."' role='button'><i class='fa fa-pencil'></i></a>
            <a class='btn btn-sm btn-danger' href='#' data-toggle='modal' data-target='#modal_delete_role' data-id='" .$role->id ."' title='" .__d('users', 'Delete this Role') ."' role='button'><i class='fa fa-remove'></i></a>
        </div>
    </td>
</tr>";

    }
?>
        </table>
<?php } else { ?>
        <div class="alert alert-warning" style="margin: 0 5px 5px;">
            <h4><i class="icon fa fa-warning"></i> <?php echo strftime("%d %b %Y, %R", time()) ." - "; ?> <?= __d('users', 'No registered Roles'); ?></h4>
            <?= __d('users', 'There are no registered Roles.'); ?>
        </div>
<?php } ?>
    </div>
    <div class="box-footer with-border">
        <a class='btn btn-success' href='<?= site_url('admin/roles/create'); ?>'><i class='fa fa-plus-square'></i> <?= __d('users', 'Create a new Role'); ?></a>
    </div>
</div>

</section>

<?php if (! $roles->isEmpty()) { ?>

<div class="modal modal-default" id="modal_delete_role">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><?= __d('users', 'Delete this Role?'); ?></h4>
            </div>
            <div class="modal-body">
                <p><?= __d('users', 'Are you sure you want to remove this Role, the operation being irreversible?'); ?></p>
                <p><?= __d('users', 'Please click the button <b>Delete</b> to proceed, or <b>Cancel</b> to abandon the operation.'); ?></p>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary pull-left col-md-3" type="button"><?= __d('users', 'Cancel'); ?></button>
                <form id="modal_delete_form" action="" method="POST">
                    <input type="hidden" name="roleId" id="delete_role_id" value="0" />
                    <input type="hidden" name="_token" value="<?= csrf_token(); ?>" />
                    <input type="submit" name="button" class="btn btn btn-danger pull-right col-md-3" value="<?= __d('users', 'Delete'); ?>">
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

<script>
$(function () {
    $('#modal_delete_role').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal

        var id = button.data('id'); // Extract the Role ID from data-* attributes

        //
        $('#delete_user_id').val(id);

        $('#modal_delete_form').attr('action', "<?= site_url('admin/roles'); ?>" + '/' + id + '/destroy');
    });
});

</script>

<?php } ?>
