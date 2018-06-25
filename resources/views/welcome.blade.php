@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        {{-- <div class="row py-4">
            <div class="col-12 d-flex justify-content-center">
                <button type="button" name="button" class="btn btn-primary" @click="FBLogin" ref="FBbtn">FB Login</button>
            </div>
        </div> --}}
        <competitor
            v-for="competitor in competitors"
            :key="competitor.id"
            :competitor="competitor"
            :fb_token="fb_token" >
        </competitor>
    </div>
@endsection
