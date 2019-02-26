@extends('layouts.admin')

@section('content')


    <div class="container">
    
        <h4 style="text-align: center;">
            Terms and conditions
            <a href="/admin/termsCreate" class="btn btn-sm btn-success right-side">new</a>
        </h4>
            

        <br>

        <p style="text-align: center;">
            This panel enables you to create, edit and delete terms and conditions for 3COB
        </p>
        <hr>
        
        @forelse($terms as $term)

            <div style="border-bottom: 0.1em solid black; padding: 0.5em 0; width: 44%; float: left; margin: 0.5em 2.5%">
                <p>{{ $term->contents }}</p>
                <p>
                    <a href="/admin/termsEdit?term_id={{$term->id}}" class="btn btn-sm btn-success">Edit</a>
                    <a href="/admin/termsDelete?term_id={{$term->id}}" class="btn btn-sm btn-danger right-side">Delete</a>
                </p>
            </div>


        @empty

            <p style="text-align: center;">
                No terms and conditions specified.
            </p>

        @endforelse
        
        
        
                    
    </div>
                    
@endsection
