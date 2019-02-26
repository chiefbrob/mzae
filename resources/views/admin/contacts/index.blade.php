@extends('layouts.admin')

@section('content')
    
    <h4 style="text-align: center;">Contacts management</h4>

    <br>

    <div class="container">

        @forelse($contacts as $contact)

        <div class="received-contact" contact_id="{{ $contact->id }}" style="border-bottom: 0.1em solid black; width: 44%; margin: 0.5em 2.5%; float: left; padding: 0.5em 0;">
            <p>
                <b>
                    {{ $contact->names }}
                    
                </b>
                <i style="float: right;">{{ $contact->email }}</i>
                <br>
                {{ $contact->message }}
            </p>


            <br>

            <a href="/admin/contacts-view?contact_id={{$contact->id}}" class="btn btn-sm btn-primary">View</a>

            @if($contact->resolver)

            Resolved by: 
            <b>
                {{ $contact->resolver }}
            </b>
            on {{ $contact->resolved_on }}

            @endif

        </div>

        


        @empty

        <p style="text-align: center;">
            No contacts received
        </p>

        @endforelse

        <br>
        <hr>
        <p>
            {{ $contacts->links() }}
        </p>
        
    </div>

    


@endsection
