<?php
if (!defined('ABSPATH')) exit();

$current_folder = (int) $_POST['current_folder'];
$current_folder = $current_folder <= 0 ? null : $current_folder;
?>

<form action="" method="post" id="form-add-folder">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="folderName" class="control-label"><?php echo __('Folder Name', 'share5s') ?>:</label>
                    <input type="text" class="form-control" name="folderName" id="folderName" value="">
                </div>
            </div>
        </div>

        <input type="hidden" name="parentId" id="parentId" value="<?php echo $current_folder ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="isPublic" class="control-label"><?php echo __('File Privacy', 'share5s') ?>:</label>
                    <select class="form-control" name="isPublic" id="isPublic">
                        <option value="1"><?php echo __('Public', 'share5s') ?> - <?php echo __('shown in search results and if someone knows the url', 'share5s') ?>.</option>
                        <option value="0" selected=""><?php echo __('Private', 'share5s') ?> - <?php echo __('no access outside of your account.', 'share5s') ?></option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="accessPassword" class="control-label"><?php echo __('Optional Password', 'share5s') ?>:</label>
                    <div class="row">
                        <div class="col-md-2 inline-checkbox">
                            <input type="checkbox" name="enablePassword" id="enablePassword" value="1">
                        </div>
                        <div class="col-md-10">
                            <input type="password" class="form-control" name="password" id="password" autocomplete="off" readonly="readonly">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <p>
                    </p>
                </div>
            </div>
        </div>
    </div>
</form>