'use strict';

$(document)
    .ready(function () {
        let slugInput = $('#slug');
        let titleInput = $('#title');


        titleInput.keyup(function () {
           $.ajax({
               type: 'GET',
               url: '/admin/generate-slug',
               dataType: 'json',
               contentType: 'application/json',
               data: {
                   text: titleInput.val()
               }
           }).done(function (response) {
               slugInput.val(response.data);
           }).fail(function (response) {
               alert('Ошибка при генерации slug');
           })
       })
    });
