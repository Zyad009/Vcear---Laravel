@extends('front.app')
@section('content')


        <div class="container">
            <div class="row">
                <div class="col-6 mx-auto">
                    <form action="{{url('major/'.$major->id)}}" method="post" class="my-5 border p-3" enctype="multipart/form-data">
                        <x-error></x-error>
                        <x-success></x-success>
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="">Major Name</label>
                            <input type="text" name="name" value="{{$major->name}}" id="" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="">Major Image</label>
                            <input type="file" value="{{$major->image}}" name="image" id="" class="form-control">
                        </div>

                        <div class="text-center">
                            <img src="{{asset('uploads/majors/'.$major->image)}}" height="300" width="300" alt="">
                        </div>

                        <div class="mb-3 p-3">
                            <input type="submit" value="Save" class="form-control btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
    </div>

    @endsection