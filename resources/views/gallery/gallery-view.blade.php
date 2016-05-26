@extends('master')

@section('content')

	<div class="row">
		<div class="col m12 center">
			<h2>{{$gallery->name}} gallery</h2>
			<div class="divider"></div>
		</div>
	</div>

	<div class="row medium-pad" id="gallery-content">
		<div class="col m12">
			<div id="gallery-images">
				@foreach($gallery->images as $image)
				<div class="col l3 m4 s6 center noPadding noMargin">
					<a href="{{ url($image->file_path) }}" data-lightbox="mygallery">
						<img src="{{ url('/gallery/images/thumbs/'. $image->file_name) }}" alt="Image" class="responsive-img">
					</a>
				</div>
				@endforeach
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col m12">
			<form action="{{ url('image/do-upload') }}" class="dropzone" id="addImages">
				{{ csrf_field() }}

				<input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
			</form>
		</div>
	</div>

	<div class="row">
		<div class="col m12">
			<a href="{{ url('gallery/list') }}" class="btn waves-effect waves-light">Back</a>
		</div>
	</div>

@endsection