/**
 * Created by Admin on 1/3/2018.
 */
$(document).on("ready", function () {
    $('[data-toggle=confirmation]').confirm({
        title: 'Delete Record?',
        theme: 'dark',
        icon: 'fa fa-question',
        content: 'Are you sure you want to delete this record? Any deleted data can not be recovered.',
        autoClose: 'cancel|10000',
        buttons: {
            confirm: {
                text: 'Ok',
                action: function (e) {
                    window.location.href = this.$target.attr('data-url');
                }
            },
            cancel: function () {
            }
        }
    });
    //hủy đơn
    $('[data-toggle=confirmcancel]').confirm({
        title: 'Hủy đơn?',
        theme: 'dark',
        icon: 'fa fa-question',
        content: 'Bạn có chắc chắn muốn hủy đơn này không, click OK để hủy đơn !',
        autoClose: 'cancel|10000',
        buttons: {
            confirm: {
                text: 'Ok',
                action: function (e) {
                    window.location.href = this.$target.attr('data-url');
                }
            },
            cancel: function () {
            }
        }
    });

});