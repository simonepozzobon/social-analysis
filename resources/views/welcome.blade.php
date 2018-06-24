@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        {{-- <div class="row py-4">
            <div class="col-12 d-flex justify-content-center">
                <button type="button" name="button" class="btn btn-primary" @click="FBLogin" ref="FBbtn">FB Login</button>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-md-6">
                <facebook-analysis :fb_token="this.fb_token"></facebook-analysis>
            </div>
            <div class="col-md-6">
                <twitter-analysis ></twitter-analysis>
            </div>
        </div>
    </div>
@endsection
