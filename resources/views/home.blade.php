@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <form method="POST" action="/upload" enctype="multipart/form-data">
                    @csrf
                    <upload-button></upload-button>
                  </form>
                </div>
                <div class="card-body">
                  <table-component :data="{{ json_encode(Auth::user()->files) }}"></table-component>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
