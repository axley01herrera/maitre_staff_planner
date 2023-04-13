<div class="text-center py-5">
    <div class="mb-4">
        <h4 class="text-primary text-uppercase fw-bolder">
            <?php echo lang('Text.welcome');?>
        </h4>
        <p class="text-muted">
            <?php echo lang('Text.sign_in_to_continue');?>
        </p>
    </div>
    <?php 
        echo view('authentication/component/inputEmail');
        echo view('authentication/component/inputPassword');
        echo view('authentication/component/btnSubmit');
    ?>
    <div class="mt-4">
        <a  href="<?php echo base_url('Authentication/recoverPassword').'?language='.$language;?>" class="text-primary">
            <?php echo lang('Text.recover_password');?>!
        </a>
    </div>
    <div class="mt-5 text-center text-muted">
        <p><?php echo lang('Text.you_do_not_have_an_account');?>? <a style="text-decoration: none;" href="<?php echo base_url('Authentication/signup')?>" class="fw-medium text-primary"> <?php echo lang('Text.signup');?> </a></p>
    </div>
</div>

<script>
    $('#button-submit').on('click', function () {

        let formValidateEmailFormat = validateEmailFormat();
        let formValidateRequiredFieldValues = requiredFieldValues();

        if(formValidateEmailFormat == 0 && formValidateRequiredFieldValues == 0) {

            $('#button-submit').attr('disabled', true);
            $('#spinner-button-submit').removeAttr('hidden');

            let post = {
                email: $('#input-email').val(),
                password: $('#input-password').val(),
            }

            $.ajax({

                type: "post",
                url: "<?php echo base_url('Authentication/login')?>",
                data: {post},
                dataType: "json",

            }).done(function(jsonResponse) {

                switch(jsonResponse.error) {

                    case 0:
                        window.location.href = "<?php echo base_url('Dashboard');?>";
                    break

                    case 1:

                        Swal.fire({
                            title: jsonResponse.msg,
                            showClass: {popup: 'animate__animated animate__fadeInDown'},
                            hideClass: {popup: 'animate__animated animate__fadeOutUp'},
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 3500
                        });

                        $('#button-submit').removeAttr('disabled');
                        $('#spinner-button-submit').attr('hidden', true);

                    break
                }

            }).fail(function(error) {

                Swal.fire({
                    title: "<?php echo lang('Error.title'); ?>",
                    showClass: {popup: 'animate__animated animate__fadeInDown'},
                    hideClass: {popup: 'animate__animated animate__fadeOutUp'},
                    position: 'top-end',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 3500
                });

                $('#button-submit').removeAttr('disabled');
                $('#spinner-button-submit').attr('hidden', true);

            });
        }
    });
</script>