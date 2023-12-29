@extends('layouts.app')

@section('content')
<div id="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Url Generated</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($urls)}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            @if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
            @endif
            @if(Session::has('errorMessage'))
            <div class="alert alert-danger">
                {{Session::get('errorMessage')}}
            </div>
            @endif
            <h4>History</h4>
            <table class="table table-bordered">
                <tr>
                    <td>SL</td>
                    <td>Long URL</td>
                    <td>Short URL</td>
                    <td>Click Count</td>
                    <td>Action</td>
                </tr>
                @foreach($urls as $key=>$url)
                <tr>
                    <td>{{++$key}}</td>
                    <td><a href="{{$url->full_link}}" target="_blank">{{$url->full_link}}</a></td>
                    <td><a href="{{$url->hash}}" target="_blank">{{url('/').'/'.$url->hash}}</a></td>
                    <td>{{$url->url_access_count}}</td>
                    <td>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('remove_url').submit();" class="btn-sm btn-primary">Remove</a>
                        <form action="{{route('remove-url')}}" method="POST" id="remove_url" class="d-none">
                            @csrf
                            <input type="hidden" name="url_id" value="{{$url->id}}">
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
@endsection