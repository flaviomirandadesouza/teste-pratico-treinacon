var AUTH = {
    autenticar: function (form) {
        $.ajax(
            {
                url: $(form).attr('action'),
                method: 'POST',
                dataType: 'JSON',
                data: $(form).serialize(),
                success: function (json) {
                    if (json.status) {
                        parent.location.href = json.redirect;
                    } else {
                        alert(json.msg);
                    }
                }
            }
        )
        return false;
    }
}