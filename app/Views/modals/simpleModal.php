<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <!-- HEADER -->
            <div class="modal-header">
                <!-- TITLE -->
                <h5 class="modal-title" id="staticBackdropLabel">
                    <?php echo $pageTitle;?>
                </h5>
                <button type="button" class="btn-close closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- BODY -->
            <div class="modal-body">
                
            </div>
            <!-- FOOTER -->
            <div class="modal-footer mt-10">
                <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal"><?php echo lang('Text.close')?></button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/js/modal.js');?>"></script>