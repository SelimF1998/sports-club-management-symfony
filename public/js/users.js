function addUser() {
    var form = document.getElementById('add-user-form');
    var formData = new FormData(form);

    $.ajax({
        type: 'POST',
        url: form.action,
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                location.reload();
            } else {
                alert('Error adding user: ' + response.errors);
            }
        },
        error: function() {
            alert('Error adding user.');
        }
    });
}

