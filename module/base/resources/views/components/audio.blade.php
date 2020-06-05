<div class="card">
    <div class="card-header">
        <h5 class="card-title">Audio file</h5>
    </div>
    <div class="card-body">

        @if (isset($data->audio_file))
            <audio controls id="holder" style="width: 100%; margin-bottom: 15px">
                <source src="{{$data->audio_file}}" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        @else
            <audio controls id="holder" style="width: 100%; margin-bottom: 15px">
                <source src="horse.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        @endif
        <div class="input-group">
            <a data-input="audio_file" data-preview="holder" class="lfm btn btn-primary" href="javascript:;" style="margin-right: 10px">
                <i class="fa fa-picture-o"></i> Select
            </a>

            <a id="delete-lfm" data-input="audio_file" data-preview="holder" class="btn btn-danger" href="javascript:;">
                <i class="fa fa-trash-o"></i> Delete
            </a>
            @if (isset($data->audio_file))
                <input id="audio_file" class="form-control" type="hidden" name="audio_file" value="{{$data->audio_file}}">
            @else
                <input id="audio_file" class="form-control" type="hidden" name="audio_file">
            @endif
        </div>
    </div>
</div>

@push('js')
    <script>
        (function( $ ){
            $.fn.filemanager = function(type, options) {
                type = 'file';

                this.on('click', function(e) {
                    var route_prefix = (options && options.prefix) ? options.prefix : '/cdn-filemanager';
                    localStorage.setItem('target_input', $(this).data('input'));
                    localStorage.setItem('target_preview', $(this).data('preview'));
                    window.open(route_prefix + '?type=' + type, 'FileManager', 'width=1024,height=768');
                    window.SetUrl = function (url, file_path) {
                        //set the value of the desired input to image url
                        var target_input = $('#' + localStorage.getItem('target_input'));
                        target_input.val(file_path).trigger('change');

                        //set or change the preview image src
                        var target_preview = $('#' + localStorage.getItem('target_preview'));
                        target_preview.attr('src', url).trigger('change');
                    };
                    return false;

                });
            }
        })(jQuery);


        $('.lfm').filemanager('file');

        $('#delete-lfm').on('click', function () {
            $('#audio_file').val('');
            $('#holder').attr('src', '{{ asset('adminux/img/no-image.jpg') }}');
        })
        $('#audio_file').on('change', function () {
           var link = $('#audio_file').val();
           var _token = $('meta[name="csrf-token"]').attr('content');
           var url = "{{route('nqadmin::voice.ajax.post')}}"
           $.ajax({
                type : 'POST',
                url: url,
                data: {
                    _token: _token,
                    link: link
                }
           })
               .done(function (resp) {
                   $('#input_length').val(resp);
               })
               .fail(function (err) {
                   console.log(err)
               })
               .always(function (resp) {

               })
        })

    </script>
@endpush