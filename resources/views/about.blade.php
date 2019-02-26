@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">About us</div>

                <div class="card-body">
                    <img src="images/logo.png" style="width: 25%; margin: 1em 37.5%" >

                        <p style="text-align: center;" class="center-50">
                            
                            Mzae template is a laravel project that has been customized for <a href="https://github.com/chiefbrob/mzi">Mzi Framework</a>. This template contains these customizations:

                            <ol>
                                <li>Admin and Api Controller setup</li>
                                <li>Authentication with username</li>
                                <li>Laravel Passport setup</li>
                                <li>Basic pages i.e. about, contact, home</li>
                                <li>Emails e.g. register, reset, login notification</li>
                                <li>Service worker.js and Manifest.js for PWAs</li>
                                <li>Intervention/image setup</li>
                            </ol>

                        </p>

                        <p>
                            This template makes it simpler to start building the backend app.
                        </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
