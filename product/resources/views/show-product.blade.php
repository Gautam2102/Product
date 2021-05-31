@extends('layouts.app')

@section('content')

<div class="container">
    <form method="POST"action="{{ route('importForm') }}" enctype="multipart/form-data">
        @csrf
       
      <center> <span class="btn btn-success ">
            <span>Import</span>
            <input type="file" name="file" id="files">
         

        </span>
        <button type="submt"class="btn btn-info">submit</button>
        </center>
    </form>
    <a href="{{url('/download')}}"class="btn btn-primary">Download File</a>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image/Video</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->description}}</td>
                <td>{{$row->price}}</td>
                <td>

                    <?php foreach (json_decode($row->file)as $image){?>
                        
                    @if(pathinfo($image, PATHINFO_EXTENSION) == 'mp4')
                    <video width="200px" height="120px" class="m-2" src="{{ asset('images/' .$image) }}"
                        controls></video>


                    @elseif(pathinfo($image, PATHINFO_EXTENSION) == 'jpg')
                    
                    <img src="{{$image}}" class="m-2"
                        style="height:60px;width:100px;maragin:10px,10px"><br>

                    @else
                   <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$image}}"
                        allowfullscreen></iframe>
                    @endif

                    <?php }?>
            <td><a href="{{url('/editproduct/'.$row->id)}}" class="btn btn-info">Edit</a><a
                        href="{{url('/deleteproduct/'.$row->id)}}" class="btn btn-danger">Delete</a></td>
            </tr>

            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image/Video</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });

    </script>

    @endsection
