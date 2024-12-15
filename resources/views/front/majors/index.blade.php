@extends('front.app')
@section('content')


        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="./index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">majors</li>
                </ol>
            </nav>
            <div>
            </div class="row">
            @auth
                @if (auth()->user()->role=='admin')

                <div class="call-12 my-3 text-center">
                    <a href="{{url("majors/add")}}" class="btn btn-success">Add major</a>
                </div>
                @endif
            @endauth
                    <x-error></x-error>
                    <x-success></x-success>
            </div>
            <div class="majors-grid">
                @forelse ($majors as $major)

                                    <div class="card p-2" style="width: 18rem;">
                    <img src="{{asset('uploads/majors/'.$major->image)}}" class="card-img-top rounded-circle card-image-circle"
                        alt="major">
                    <div class="card-body d-flex flex-column gap-1 justify-content-center">
                        <h4 class="card-title fw-bold text-center">{{$major->name}}</h4>
                        <a href="{{url("majors/".$major->id."/doctors")}}" class="btn btn-outline-primary card-button">Browse Doctors</a>

                        @auth
                        @if (auth()->user()->role=='admin')

                        <a href="{{url("majors/".$major->id."/edit")}}" class="btn btn-outline-info card-button">Edit Major</a>
                        <form action="{{url("major/".$major->id)}}" method="POST" class="p-2 text-center" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger ">Delete Major</button>
                        </form>
                        @endif
                        @endauth
                    </div>
                </div>
                    @empty

                    <div class="tex-center alert alert-info">
                        there is no majors yet !
                    </div>
                @endforelse

            </div>

        </div>
        <div class="text-center p-3">
            {{$majors->links()}}
        </div>
    </div>
    @endsection