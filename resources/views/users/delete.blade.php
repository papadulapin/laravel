<form method="POST" action="{{ $action }}">
	@csrf
	 <input name="_method" type="hidden" value="{{ $method }}">
	<div class="form-group">
		<button type="submit" class="btn btn-danger">{{ $submitButton }}</button>
	</div>
</form>