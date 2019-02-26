@extends('layouts.admin')

@section('content')

    <div class="container">
    
        <h4 style="text-align: center;">Edit Terms and Conditions</h4>

        <br>

        <form method="post" action="/admin/termsSave" class="center-50">
            @csrf
            <input type="hidden" name="term_id" value="{{$term->id}}">


            <p style="text-align: center;">
                <textarea name="contents" required="required" rows="5" placeholder="Insert contents here" class="form-control">{{$term->contents}}</textarea>
            </p>

            <p>
                <input type="submit" name="" value="Save" class="btn btn-sm btn-primary">
                <a href="/admin/termsDelete?term_id={{$term->id}}" class="btn btn-sm btn-danger right-side">Delete</a>
            </p>
            
        </form>
        
        

        
        

                    
    </div>
                    
@endsection
