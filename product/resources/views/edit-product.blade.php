@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD PRODUCT') }}</div>
                @if ($message = Session::get('success'))

                <div class="alert alert-success alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ $message }}</strong>

                </div>

                @endif
                <div class="card-body">
                    <form method="POST" action="{{route('updateproduct')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" class="form-control" value="{{$data->id}}">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $data->name }}" autocomplete="name" autofocus required>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description"
                                class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="description"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    value="{{ $data->description}}" required>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="text" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('price') is-invalid @enderror"
                                    name="price" value="{{$data->price}}" required>

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <?php foreach (json_decode($data->file)as $image){?>
                        @if(pathinfo($image, PATHINFO_EXTENSION) == 'mp4')
                        <video width="200px" height="120px" src="{{ asset('images/'.$image) }}" controls></video>
                        @elseif(pathinfo($image, PATHINFO_EXTENSION) == 'jpeg')
                        <img src="{{ asset('images/' .$image) }}" class="m-2"
                            style="height:60px;width:100px;maragin:10px,10px"><br>

                        @else



                        <iframe width="200" height="120" src="https://www.youtube.com/embed/{{$image}}"
                            allowfullscreen></iframe>
                        @endif





                        <?php }?>


                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Upload File') }}</label>
                            <div class="col-md-6">

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                    Upload File
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Upload File</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">


                                                    <div class="wrapper">
                                                        <input type="radio" name="file" value="url" id="option-1">

                                                        <input type="radio" name="file" value="file" id="option-2"
                                                            checked>
                                                        <label for="option-1" class="option option-1">
                                                            <div class="dot"></div>
                                                            <span>Enter URL</span>
                                                        </label>
                                                        <label for="option-2" class="option option-2">
                                                            <div class="dot"></div>
                                                            <span>File Upload</span>
                                                        </label>
                                                    </div><br><br>
                                                    <div id="files">
                                                        <div>


                                                            <!--To give the control a modern look, I have applied a stylesheet in the parent span.-->
                                                            <span class="btn btn-success fileinput-button">
                                                                <span>Select Attachment</span>
                                                                <input type="file" name="file[]" id="files"
                                                                    multiple="multiple"><br />
                                                            </span>
                                                            <output id="Filelist"></output>
                                                        </div>
                                                    </div>

                                                    <div id="abc" style="">
                                                        <label for="filename">Filename</label>
                                                        <input id="filename" type="text" class="form-control"
                                                            placeholder="Enter URL" onchange="recordToFilename();"
                                                            href="javascript:void(0);">
                                                    </div>
                                                    <div id="abc">
                                                        <input type="hidden" name="file" id="myId" value="123">


                                                        <pre id="myCode"></pre>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">save</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('ADD') }}
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
