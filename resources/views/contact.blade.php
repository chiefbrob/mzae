@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Contact us</div>

                <div class="card-body">
                    <form method="post" action="/contact">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Full Name') }}:
                            </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="" required autofocus placeholder="">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Email') }}:
                            </label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="" required step="any">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="message" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Message') }}:
                            </label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="message" required="required"></textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    {{ __('Send Message') }}
                                </button>

                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
