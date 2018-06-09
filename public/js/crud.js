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
                        swal({
                            icon: 'success',
                            text: "O registro foi salvo com sucesso!",
                            button: 'Ok'
                        }).then(function (value) {
                            parent.location.href = json.redirect;
                        })
                    } else {
                        swal({
                            icon: 'error',
                            text: json.msg,
                            button: 'Ok'
                        })
                    }
                }
            }
        )
        return false;
    },
    excluir: function (url) {

        swal({
            icon: 'warning',
            title: 'Este processo é irreversível!',
            text: "Você tem certeza que deseja remover este registro?",
            buttons: {
                cancel: "Não",
                confirm: {
                    text: 'Sim',
                    value: true
                }
            },
        }).then(function (value) {
            if (value) {
                $.ajax(
                    {
                        url: url,
                        method: 'POST',
                        dataType: 'JSON',
                        success: function (json) {
                            if (json.status) {
                                swal({
                                    icon: 'success',
                                    text: "O registro foi removido com sucesso!",
                                    button: 'Ok'
                                }).then(function (value) {
                                    parent.location.href = json.redirect;
                                })
                            } else {
                                swal({
                                    icon: 'error',
                                    text: json.msg,
                                    button: 'Ok'
                                })
                            }
                        }
                    }
                )
            }
        })
        return false;
    }
}