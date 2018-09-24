<div class="modal fade" id="modal{{ isset($bulkAction) ? '' : '-' . $permission->id }}">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

		  <div class="modal-header">
		    <button type="button" class="close " data-dismiss="modal">&times;</button>
		  </div>
		  
		  <div class="modal-slug mx-auto">
			   <br>
			   <div id="modal-message{{ isset($bulkAction) ? '' : '-' . $permission->id }}" class="text-center">{{ $modalDefaultMsg }}</div>					  
		  </div>

	    <ul id="modal-actions" class="list-inline mx-auto">
	      <li class="list-inline-item">

	       <form method="POST" action="{{ $action }}">
			  @csrf
		  	<input name="_method" type="hidden" value="{{ $method}} ">

		  	@if(isset($bulkAction))
		  	<input id="ids" name="ids" type="hidden" value="">
		  	@endif
		  	
	  		<button type="submit" class="btn btn-danger">{{ $submitButton }}</button>
			</form>

	      </li>
	      <li class="list-inline-item"><button type="button" class="btn btn-primary" data-dismiss="modal">No</button></li>
	    </ul>
		  
		  <div class="modal-footer">
		    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>
		  
		</div>
	</div>
</div>