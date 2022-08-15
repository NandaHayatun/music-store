@extends('artists.layout')
     
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left" style="height: 5rem;">
                <h2>Music Store</h2>
            </div>
            <div class="pull-right" style="height: 4rem;">
                <a class="btn btn-primary" href="{{ route('artists.create') }}"> Create New artist</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Package Name</th>
            <th>Artist Name</th>
            <th>Date Release</th>
            <th>Sample Audio</th>
            <th>Price</th>
            <th width="170px">Action</th>
        </tr>
        @foreach ($artists as $artist)
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="/images/{{ $artist->ImageURL }}" width="100px">{{ $artist->PackageName }}</td>
            <td>{{ $artist->ArtistName }}</td>
            <td> {{ date('d M Y', strtotime($artist->ReleaseDate))}} </td>
            <td>
                <div class="playStopPosition">
                    <audio src="{{ $artist->SampleURL }}" onended="on_playing_ended(this);" class="player" >
                    </audio>
                    <div class="play-stopbtn play-icon"><img src="https://img.icons8.com/dotty/344/circled-play.png" alt="imgplay"></div>
                </div>
               
            </td>
            <td>{{ $artist->Price }} <b>円</b></td>
            <td style="text-align: center">
                <form action="{{ route('artists.destroy',$artist->ArtistID) }}" method="POST">
                    <a class="btn btn-primary btn-sm btn-xs" href="{{ route('artists.edit',$artist->ArtistID) }}">Edit</a>

                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-xs show-alert-delete btn-sm" data-name="{{ $artist->PackageName }}" data-toogle="tooltip" title='Delete'>Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    {!! $artists->links() !!}
    <script>
        $(document).ready(function(){
        $(document).on('click' , '.play-stopbtn' , function(){
                var playStop = $(this),
                    audioPlayStop = $(this).parent().find('audio')[0];
                    
                if($('.play-stopbtn.stop-icon').not(playStop).length){
                var playStopPrev = $('.play-stopbtn.stop-icon').not(playStop),
                    audioPlayStopPrev = $('.play-stopbtn.stop-icon').parent().find('audio')[0];
                playStopPrev.toggleClass('play-icon stop-icon');
                audioPlayStopPrev.pause();
                }
                playStop.toggleClass('play-icon stop-icon');
                audioPlayStop.paused ? audioPlayStop.play() : audioPlayStop.pause();
            })
        });


        function on_playing_ended(el){
        $(el).parent().find('.play-stopbtn').toggleClass('play-icon stop-icon');
        }
    </script>
    
    <script type="text/javascript">
    
    $('.show-alert-delete').click(function(event) {
      var form =  $(this).closest("form");
      var name = $(this).data("name");
      event.preventDefault();
      swal({
          title: `Are you sure you want to delete ${name}?`,
          text: "If you delete this Music Data, it will be gone forever.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            swal("You have successfull delete this Music Data!",{icon: "success",});
            form.submit();
        }
      });
  });
   
    </script>   
    <style>
        th{
            text-align: center;
            font-size: 16px;
        }
        td{
            text-align: left;
            font-size: 14px;
        }
        i{
            font-size: 30px !important;
            padding: 10px;
            margin-left: 5px;
        }

        img{
            width : 80px;
            height: 80px;
        }
        .playStopPosition{
            padding-left: 30px;
        }
        
        .play-stopbtn{
            padding : 10px;
            margin : 10px;
            color : #fff;
            border-radius : 50px;
            width : 50px;
            height: 50px;
            text-align : center;
            cursor : pointer;
        }

        .play-icon{
            background : rgb(47, 134, 214);
        }
        .play-icon img{  
            content: url(https://img.icons8.com/dotty/344/circled-play.png);
            width: 45px;
            height: 45px;
            margin-top: -7px; 
            margin-left: -7px;
        }
        .stop-icon{
            background : red;
        }
        .stop-icon img{
            content: url(https://img.icons8.com/dotty/344/stop-circled.png);
            width: 45px;
            height: 45px;
            margin-top: -7px; 
            margin-left: -7px;
        }
    </style>
    
@endsection