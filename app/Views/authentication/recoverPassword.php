<div class="text-center  py-5">
    <div class="mb-4">
        <h4 class="text-primary text-uppercase fw-bolder">
            <?php echo lang('Text.recover_password'); ?>
        </h4>
        <p class="text-muted">
            <?php echo lang('Text.write_your_email');?>
        </p>
    </div>
    <?php
        echo view('authentication/component/inputEmail');
        echo view('authentication/component/btnSubmit');
        echo view('authentication/component/backButton');
    ?>
</div>
<script>
    $('#button-submit').on('click', function () {

        let formValidateEmailFormat = validateEmailFormat();
        let formValidateRequiredFieldValues = requiredFieldValues();

        if(formValidateEmailFormat == 0 && formValidateRequiredFieldValues == 0) {

            $('#button-submit').attr('disabled', true);
            $('#spinner-button-submit').removeAttr('hidden');

            $.ajax({

                type: "post",
                url: "<?php echo base_url('Authentication/createNewPasswordEmail');?>",
                data: {
                    'language' : '<?php echo $language;?>',
                    'post': {
                        email: $('#input-email').val(),
                    }
                },
                dataType: "json",
                
            }).done(function(jsonResponse) {

                switch(jsonResponse.error) {

                    case 0:

                        Swal.fire({
                            title: jsonResponse.msg,
                            showClass: {popup: 'animate__animated animate__fadeInDown'},
                            hideClass: {popup: 'animate__animated animate__fadeOutUp'},
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonText: "<?php echo lang('Text.close');?>",
                            confirmButtonColor: '#6c757d',
                        });

                    break

                    case 1:

                        Swal.fire({
                            title: jsonResponse.msg,
                            showClass: {popup: 'animate__animated animate__fadeInDown'},
                            hideClass: {popup: 'animate__animated animate__fadeOutUp'},
                            icon: 'error',
                            showConfirmButton: true,
                            confirmButtonText: "<?php echo lang('Text.close');?>",
                            confirmButtonColor: '#6c757d',
                        });

                        $('#button-submit').removeAttr('disabled');
                        
                    break
                }

                $('#spinner-button-submit').attr('hidden', true);

            }).fail(function(error){

                Swal.fire({
                    title: "<?php echo lang('Text.global_error_msg'); ?>",
                    showClass: {popup: 'animate__animated animate__fadeInDown'},
                    hideClass: {popup: 'animate__animated animate__fadeOutUp'},
                    position: 'top-end',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });

                $('#button-submit').removeAttr('disabled');
                $('#spinner-button-submit').attr('hidden', true);
            });
        }
    });
</script>