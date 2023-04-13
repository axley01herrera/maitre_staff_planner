$('#modal').modal('show');

$('.closeModal').on('click', function () {

    $('#modal').modal('hide');
    $('#main-modal').html('');

});