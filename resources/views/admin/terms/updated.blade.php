@extends('layouts.admin')

@section('content')

    <div class="container">
    
        <h4 style="text-align: center;">Term update success</h4>

        <br>

        <div class="center-50">

            <p style="text-align: center;">
                {{ $term->contents }}
            </p>

            <p>
                <a href="/admin/termsEdit?term_id={{$term->id}}" class="btn btn-sm btn-success">Edit</a>
                <a href="/admin/terms" class="btn btn-sm btn-danger right-side">Back</a>
            </p>
            
        </div>

        
        
        

        
        

                    
    </div>
                    
@endsection
