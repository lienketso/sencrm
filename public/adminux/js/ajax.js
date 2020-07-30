jQuery(document).ready(function($) {
    var url = $('input[name="url_member"]').val();
    $(document).on('keyup', '.bs-searchbox input[type=search]', function (e) {
        var _this = $(e.currentTarget);
        var customerNode = $('.bs-searchbox input[type=search]').val();
        $.ajax({
            type: "GET",
            url: url,
            data: "keyword="+customerNode
        })
            .done(function(res){
                var html = res;
                $('#parent').html(html);
                $('.selectpicker').selectpicker('refresh');
            })
            .always(function(resp) {
                setTimeout(() => {
                    $('.loading').css('display', 'none');
                }, 2000)
            });
    });

});

