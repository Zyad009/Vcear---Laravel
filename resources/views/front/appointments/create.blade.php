@extends('front.app')
@section('content')
    
      <div class="container">
        <nav
          style="--bs-breadcrumb-divider: '>'"
          aria-label="breadcrumb"
          class="fw-bold my-4 h4"
        >
          <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item">
              <a class="text-decoration-none" href="../index.html">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a class="text-decoration-none" href="./index.html">doctors</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{auth()->user()->name}}
            </li>
          </ol>
        </nav>
        <div class="d-flex flex-column gap-3 details-card doctor-details">
          <div class="details d-flex gap-2 align-items-center">
            <img
              src="{{asset('uploads/doctors/'.$user->image)}}"
              alt="doctor"
              class="img-fluid rounded-circle"
              height="150"
              width="150"
            />
            <div class="details-info d-flex flex-column gap-3">
              <h4 class="card-title fw-bold">{{$user->name}}</h4>
              <h6 class="card-title fw-bold">
                  Major: {{$user->major->name}}
              </h6>
            </div>
          </div>
          <hr />
          <form class="form" method="POST" action="{{route('appointments.store',$user->id)}}" novalidate>
            @csrf
            <x-success></x-success>
            <div class="form-items">
              <div class="mb-3">
                <label class="form-label required-label" for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{auth()->user()->name}}" id="name" required />
                @error("name")
                  <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label required-label" for="phone"
                  >Phone</label
                >
                <input type="tel" name="phone" class="form-control" id="phone" required />
                @error("phone")
                  <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label required-label" for="email"
                  >Email</label
                >
                <input type="email" class="form-control" name="email" value="{{auth()->user()->email}}" id="email" required />
                @error("email")
                  <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
            <button type="submit" class="btn btn-primary">
              Confirm Booking
            </button>
          </form>
        </div>
      </div>

@endsection