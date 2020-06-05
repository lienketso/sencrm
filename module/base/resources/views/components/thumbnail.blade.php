@php
	$defaultName = 'thumbnail';
	$defaultTitle = 'Thumbnail';
	if (isset($name)) {
		$defaultName = $name;
	}

	if (isset($title)) {
		$defaultTitle = $title;
	}

	if (isset($image)) {
		$defaultData = $image;
	} else {
		if (isset($data)) {
			$defaultData = $data->thumbnail;
		}
	}
@endphp

<div class="card">
	<div class="card-header">
		<h5 class="card-title">{{$defaultTitle}}</h5>
	</div>
	<div class="card-body">
		<img id="holder"
		     style="margin-bottom:10px; width: 100%"
		     class="img-fluid"
		     @if (isset($defaultData))
		        src="{{ (!empty($defaultData)) ? asset($defaultData) : asset('adminux/img/no-image.jpg') }}"
		     @else
		        src="{{ (!empty(old($defaultName))) ? asset(old($defaultName)) : asset('adminux/img/no-image.jpg') }}"
		     @endif
		>
		<div class="input-group">
			<a data-input="{{$defaultName}}" data-preview="holder" class="lfm btn btn-primary" href="javascript:;" style="margin-right: 10px">
				<i class="fa fa-picture-o"></i> Select
			</a>
			
			<a id="delete-lfm" data-input="{{$defaultName}}" data-preview="holder" class="btn btn-danger" href="javascript:;">
				<i class="fa fa-trash-o"></i> Delete
			</a>
			@if (isset($defaultData))
				<input id="{{$defaultName}}" class="form-control" type="hidden" name="{{$defaultName}}" value="{{$defaultData}}">
			@else
				<input id="{{$defaultName}}" class="form-control" type="hidden" name="{{$defaultName}}">
			@endif
		</div>
	</div>
</div>

@push('js')
<script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script>
	$('.lfm').filemanager('image');
	$('#delete-lfm').on('click', function () {
		$('#{{$defaultName}}').val('');
		$('#holder').attr('src', '{{ asset('adminux/img/no-image.jpg') }}');
	})
</script>
@endpush