@extends('layouts.admin')

@section('content')

	<style type="text/css">
		.received-contact {
			border: 0.1em solid black;
			width: 95%;
			margin: 0.5em 2.4%;
			padding: 0.5em;
		}
	</style>

	<div class="container">

		<h4 style="text-align: center;">Contact management</h4>

	    <br>
		
		<div class="center-50">

			<p>
				<b>
					{{ $contact->names }}
				</b>
				<i style="float: right;">{{ $contact->email }}</i>
			</p>

			<p>
				{{ $contact->message }}
			</p>

			<hr>

			<p>
				Received: {{ $contact->created_at }}
			</p>

			<br>

			

			@if($contact->resolver)

			Resolved by: 
			<b>
				{{ $contact->resolver }}
			</b>

			at {{ $contact->resolved_on }} <br>
			Notes: {{ $contact->notes }}

			<hr>
			<a href="/admin/contacts" class="btn btn-sm btn-danger">Back</a>

			@else

			<form method="post" action="/admin/contacts-resolve" id="contactsResolveForm">
				@csrf
				<input type="hidden" name="contact_id" value="{{ $contact->id }}">
				<label>Notes</label>
				<textarea class="form-control" id="resolve_notes" name="notes" required="">No notes on this</textarea>
			
			
				<hr>
				<input type="submit" name="" class="btn btn-sm btn-primary" value="Resolve">
				<a href="/admin/contacts" class="btn btn-sm btn-danger  right-side">Back</a>
			</form>

			@endif
			
		</div>
	    
		
	</div>
    
    

	
	<script type="text/javascript">
		
		function resolve(){
			var notes = $('#resolve_notes').val();
			if(notes.length == 0)
			{
				$.notify('danger','Include some notes');
				return;
			}
			$('#contactsResolveForm').submit();
			
		}
	</script>



@endsection
