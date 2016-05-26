@extends('master')

@section('header')
	<!-- Dropdown Structure -->
	<ul id="dropdown1" class="dropdown-content">
	  <li><a href="#!">One</a></li>
	  <li><a href="#!">Two</a></li>
	  <li class="divider"></li>
	  <li><a href="{{ url('user/logout') }}">Logout</a></li>
	</ul>
	<ul id="dropdownSideNav" class="dropdown-content">
	  <li><a href="#!">One</a></li>
	  <li><a href="#!">Two</a></li>
	  <li class="divider"></li>
	  <li><a href="{{ url('user/logout') }}">Logout</a></li>
	</ul>

	<nav>
    	<div class="nav-wrapper">
	      <a href="#!" class="brand-logo">Logo</a>
	      <a href="#" data-activates="test" class="button-collapse"><i class="material-icons">menu</i></a>
	      <ul class="right hide-on-med-and-down">
	        <li><a href="sass.html">Sass</a></li>
	        <li><a href="badges.html">Components</a></li>
	        <li><a href="collapsible.html">Javascript</a></li>
	        <!-- Dropdown Trigger -->
	      <li><a class="dropdown-button" href="#!" data-activates="dropdownSideNav">{{ $user->name }}<i class="material-icons right">arrow_drop_down</i></a></li>
	      </ul>
	      <ul class="side-nav" id="test">
	        <li><a href="sass.html">Sass</a></li>
	        <li><a href="badges.html">Components</a></li>
	        <li><a href="collapsible.html">Javascript</a></li>
	        <!-- Dropdown Trigger -->
	      	<li><a class="dropdown-button" href="#!" data-activates="dropdown1">{{ $user->name }}<i class="material-icons right">arrow_drop_down</i></a></li>
	      </ul>
    	</div>
  </nav>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1 class="center">My Galleries</h1>
		</div>
	</div>
	<div class="row">
		<div class="col m4 offset-m4">

			@if(count($errors) > 0)
				<div class="promptCard card error xsmall-pad">
					<ul>
						@foreach($errors->all() as $error)
							<li class="white-text center">{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<form action="{{ url('gallery/save') }}" class="form" method="post">
				<div class="col s12 center">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="input-field">
						<input type="text" name="gallery_name" id="gallery_name" class="form-control" value="{{ old('gallery_name') }}" >
						 <label for="gallery_name">Gallery Name</label>
					</div>
					<button class="btn waves-effect waves-light">Add</button>
				</div>
			</form>
		</div>
	</div> <!-- END row -->

	<div class="row">
		<div class="col m8 offset-l2">
			@if($galleries->count() > 0)
				<table class="highlight hoverable bordered centered">
					<thead class="lime accent-1">
						<tr>
							<th colspan="2" class="center">Gallery name</th>
						</tr>
					</thead>
					<tbody>

						@foreach($galleries as $gallery)
						<tr>
							<td>
								{{ $gallery->name }}
								@if ($gallery->images()->count() > 0)
									@if ($gallery->images()->count() == 1)
										 ({{ $gallery->images()->count() }} image)
									@elseif ($gallery->images()->count() > 1)
										({{ $gallery->images()->count() }} images)
									@endif
								@else
									(No image)
								@endif
							</td>
							<td>
								<a href="{{ url('gallery/view/' . $gallery->id) }}">View</a> /
								<a href="{{ url('gallery/delete/' . $gallery->id) }}">Delete</a>
							</td>
						</tr>
						@endforeach

					</tbody>
				</table>
			@endif
		</div>
	</div> <!-- END row -->
@endsection