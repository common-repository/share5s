<?php
if (!defined('ABSPATH')) exit();
?>
<div id="share5sFileManager">

    <div class="toolbar-container">

        <div class="col-md-6 col-sm-8 clearfix">
            <div class="user-info pull-left pull-none-xsm responsiveAlign">
                <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group responsiveAlign" id="uploadFileLink" style="margin-left: 0px;">
                        <button type="button" class="btn btn-green" id="share5s-upload"><i class="entypo-upload"></i> <?php echo __('Upload', 'share5s') ?></button>

                        <button type="button" class="btn btn-white" id="share5s-add-folder"><i class="entypo-plus"></i> <?php echo __('Add Folder', 'share5s') ?></button>

                        <button type="button" class="btn btn-white" id="share5s-selected-all"><i class="entypo-plus"></i> <?php echo __('Select All', 'share5s') ?></button> |

                        <button class="btn btn-white btn-active-selected disabled" id="share5s-show-link" type="button" disabled><i class="entypo-link"></i> <?php echo __('Links', 'share5s') ?></button>

                        <button class="btn btn-white btn-active-selected disabled" id="share5s-delete-item" type="button" disabled><i class="entypo-cancel"></i> <?php echo __('Delete', 'share5s') ?></button>

                        <a href="https://share5s.com/account_home.html" target="_blank" class="btn btn-white"><?php echo __('More Option', 'share5s') ?></a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="share5s-form-upload">
        <div id="share5s-file-list">

        </div>

        <div id="share5s-progress">
            <div class="share5s-progress-bar"></div>
        </div>

        <div id="share5s-drop-upload">
            <p><?php echo __('Drag & drop files here or click to browse', 'share5s') ?></p>
        </div>
    </div>

    <div class="share5s-br">
        <a href="javascript:void(0)" class="share5-back">&lsaquo;&lsaquo; <?php echo __('Home back', 'share5s') ?></a>
    </div>

    <div id="" class="fileManager fileManagerIcon">
        <ul class="fileListing">

        </ul>
    </div>

    <div id="share5s-loading">
        <img src="<?php echo plugins_url('share5s/images/loading.gif') ?>">
    </div>

    <div id="share5s-modal">

        <div class="share5s-modal-content">
            <div class="share5s-modal-header">
                <button type="button" class="close">×</button>
                <h4 class="modal-title"><?php echo __('Add Folder', 'share5s') ?></h4>
            </div>

            <div class="share5s-modal-body">

            </div>

            <div class="share5s-modal-footer">
                <button type="button" class="btn btn-info" id="btn-add-folder"><i class="entypo-check"></i> <?php echo __('Add Folder', 'share5s') ?></button>
            </div>
        </div>

    </div>
</div>

