@extends('artists.layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Music Detail</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('artists.index') }}"> Back</a>
            </div>
        </div>
    </div>
     
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Sorry!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('artists.update',$artist->ArtistID) }}" method="POST" enctype="multipart/form-data"> 
        @csrf
        @method('PUT')
     
         <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6" style="margin-top: 30px;">
                <div class="form-group">
                    <strong>Package Image :</strong>
                    <input type="file" name="ImageURL" class="form-control" placeholder="Image URL">
                    <img src="/images/{{ $artist->ImageURL }}" width="300px" height="300px">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Package Name:</strong>
                    <input type="text" name="PackageName" value="{{ $artist->PackageName }}" class="form-control" placeholder="Package Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Artist Name:</strong>
                    <input type="text" name="ArtistName" value="{{ $artist->ArtistName }}" class="form-control" placeholder="Artist Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>Date Release :</strong>
                    <input type="date" name="ReleaseDate" value="{{ $artist->ReleaseDate }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Price (円):</strong>
                    <input type="number" name="Price" value="{{ $artist->Price }}" class="form-control" placeholder="Price">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Sample Audio URL:</strong>
                    <input type="text" name="SampleURL" value="{{ $artist->SampleURL }}" class="form-control" placeholder="Sample URL">
                </div>
            </div>           
            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 20px;">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
     
    </form>
@endsection