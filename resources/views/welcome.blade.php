@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        {{-- <div class="row py-4">
            <div class="col-12 d-flex justify-content-center">
                <button type="button" name="button" class="btn btn-primary" @click="FBLogin" ref="FBbtn">FB Login</button>
            </div>
        </div> --}}
        <div class="row" v-for="competitor in competitors" :key="competitor.id">
            <div class="col-md-6">
                <facebook-analysis :competitor="competitor" :fb_token="fb_token"></facebook-analysis>
            </div>
            <div class="col-md-6">
                <twitter-analysis :competitor="competitor"></twitter-analysis>
            </div>
        </div>
    </div>
@endsection
