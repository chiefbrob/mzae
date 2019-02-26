@extends('layouts.admin')

@section('content')

    <div class="container">
    
        <h4 style="text-align: center;">New Terms and Conditions</h4>

        <br>

        <form method="post" action="/admin/termsCreated" class="center-50">
            @csrf


            <p style="text-align: center;">
                <textarea name="contents" required="required" rows="5" placeholder="Insert contents here" class="form-control"></textarea>
            </p>

            <p>
                <input type="submit" name="" value="Save" class="btn btn-sm btn-primary">
                <a href="/admin/terms" class="btn btn-sm btn-danger right-side">Back</a>
            </p>
            
        </form>
        
        

        
        

                    
    </div>
                    
@endsection
