<div class="text-center py-5">
    <div class="mb-4">
        <h4 class="text-primary text-uppercase fw-bolder">
            <?php echo lang('Text.signup');?>
        </h4>
        <p class="text-muted">
            <?php echo lang('Text.fill_the_form');?>
        </p>
    </div>
    <?php 
        echo view('authentication/component/inputEmail');
        echo view('authentication/component/inputPassword');
    ?>
    <div class="row mt-2 mb-2">
        <div class="col-12">
            <input id="cbx-term" type="checkbox"> <?php echo lang('Text.i_have_read_i_accept_the');?> <a id="show-term" href="#"><?php echo lang('Text.terms')?></a> <?php echo lang('Text.and');?> <a id="show-privacy-policy" href="#"><?php echo lang('Text.privacy_policy')?></a>
            <p id="msg-cbx-term" class="text-danger text-center"></p>
        </div>
    </div>
    <?php echo view('authentication/component/btnSubmit'); ?>
</div>

<script>

    $('#button-submit').on('click', function () {

        let resultValidateEmailFormat = validateEmailFormat();
        let resultValidateRequiredFieldValues = requiredFieldValues();
        let resultCheckAcceptTerms = checkAcceptTerms();

        if(resultValidateEmailFormat == 0 && resultValidateRequiredFieldValues == 0 && resultCheckAcceptTerms == 0) {

            $.ajax({

                type: "post",
                url: "<?php echo base_url('Authentication/signup');?>",
                data: {post},
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
                            confirmButtonText: "<?php echo lang('Button.close')?>",
                            confirmButtonColor: '#6c757d',
                        });
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
                    timer: 1500
                });

            });
        }

    });

    $('#show-term').on('click', function (event) {

        event.preventDefault();

        $.ajax({

            type: "post",
            url: "<?php echo base_url('Authentication/showTerm');?>",
            data: {
                'language': '<?php echo $language;?>'
            },
            dataType: "html",
            
        }).done(function(htmlResponse) {

            $('#main-modal').html(htmlResponse);

        }).fail(function(error) {

            Swal.fire({
                title: "<?php echo lang('Error.title'); ?>",
                showClass: {popup: 'animate__animated animate__fadeInDown'},
                hideClass: {popup: 'animate__animated animate__fadeOutUp'},
                position: 'top-end',
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            });
            
        });
    });

    $('#show-privacy-policy').on('click', function () {

        event.preventDefault();

        $.ajax({

            type: "post",
            url: "<?php echo base_url('Authentication/showPrivacyPolicy');?>",
            data: {
                'language': '<?php echo $language;?>'
            },
            dataType: "html",
            
        }).done(function(htmlResponse) {

            $('#main-modal').html(htmlResponse);

        }).fail(function(error) {

            Swal.fire({
                title: "<?php echo lang('Error.title'); ?>",
                showClass: {popup: 'animate__animated animate__fadeInDown'},
                hideClass: {popup: 'animate__animated animate__fadeOutUp'},
                position: 'top-end',
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            });
            
        });
        
    });

    function checkAcceptTerms() {

        let response = '';

        if($('#cbx-term').prop('checked')) 
        {
            $('#msg-cbx-term').html("");
            response = 0;
        } 
        else
        {
            $('#msg-cbx-term').html("<?php echo lang('Text.you_must_accept_the_terms_and_privacy_policy');?>");
            response = 0;
        } 
                
        return response;
    }

</script>