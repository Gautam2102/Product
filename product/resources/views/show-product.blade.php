@extends('layouts.app')

@section('content')

<div class="container">
    <center>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Import File
        </button>
    </center>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Upload file</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" name="myForm" action="{{ route('importForm') }}"
                        onsubmit="return validateForm()" enctype="multipart/form-data">
                        @csrf

                        <center> <label for="avatar">Choose an Excel or CSV file:<input type="file" name="file"
                                    class="form-control" id="file" onchange="return fileValidation()" /></label>
                            <br />
                            @error('file')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <br>
                            <button type="submt" class="btn btn-info">submit</button>
                        </center>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

</div>
<div class="container">
    @if ($message = Session::get('success'))

    <script>
        swal("Great job !", "{!! $message !!}", "success", {

            button: "ok",

        })

    </script>

    @endif
    <a href="{{url('download')}}" class="btn btn-primary">Download File</a>
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

                    <img src="{{$image}}" class="m-2" style="height:60px;width:100px;maragin:10px,10px"><br>

                    @else
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$image}}"
                        allowfullscreen></iframe>
                    @endif

                    <?php }?></td>
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

        function fileValidation() {
            var fileInput =
                document.getElementById('file');

            var filePath = fileInput.value;

            // Allowing file type
            var allowedExtensions =
                /(\.xlsx|\.csv|\.xls)$/i;

            if (!allowedExtensions.exec(filePath)) {
                swal("Invalid file type !", "file type should be xlsx or csv", {

                    button: "ok",

                })
                fileInput.value = '';
                return false;
            }

        }

        function validateForm() {
            var x = document.forms["myForm"]["file"].value;
            if (x == "") {
                swal("file field is required !", "file type should be xlsx or csv", {

                    button: "ok",

                })
                return false;
            }
        }

    </script>

    @endsection
