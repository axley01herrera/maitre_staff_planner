<script>

    function validateEmailFormat() {

        let response = 1;
        let inputValue = '';
        let validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
        let msg = '';

        $('.email').each(function() {

            inputValue = $(this).val();

            if(inputValue != '') {

                msg = $(this).attr('id');

                if(validEmail.test(inputValue)) {

                    $(this).removeClass('is-invalid');
                    $('#msg-' + msg).html('');
                    response = 0;
                    
                } else {

                    $(this).addClass('is-invalid');
                    $('#msg-' + msg).html("<?php echo lang('Text.invalid_email');?>");
                }
            }
        });

        return response;
    }

    function requiredFieldValues() {
        
        let response = 0;
        let inputValue = '';
        
        let msg = '';

        $('.required').each(function() {

            inputValue = $(this).val();
            msg = $(this).attr('id');

            if(inputValue === '') {

                $(this).addClass('is-invalid');
                $('#msg-' + msg).html("<?php echo lang('Text.required');?>");
                response = 1;
            } 
        });

        return response;
    }

    $('.focus').on('focus', function () {

        $(this).removeClass('is-invalid');
        $('#msg-' + $(this).attr('id')).html('');
    });
    
</script>