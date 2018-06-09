var CRUD = {
    salvar: function (form) {
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
    },
    excluir: function (url) {
        $.ajax(
            {
                url: url,
                method: 'POST',
                dataType: 'JSON',
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