@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Gallery {{ $item->title }}</h1>
        </div>

        {{-- menampilkan list eror jika terdapat eror --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('gallery.update', $item->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $item->title }}"
                            readonly="enabled">
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" name="location" value="{{ $item->location }}"
                            readonly="enabled">
                    </div>
                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea name="about" rows="10" class="d-block w-100 form-control" readonly="enabled">{{ $item->about }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="featured_event">Featured Event</label>
                        <input type="text" class="form-control" name="featured_event" value="{{ $item->featured_event }}"
                            readonly="enabled">
                    </div>
                    <div class="form-group">
                        <label for="language">Language</label>
                        <input type="text" class="form-control" name="language" value="{{ $item->language }}"
                            readonly="enabled">
                    </div>
                    <div class="form-group">
                        <label for="foods">Foods</label>
                        <input type="text" class="form-control" name="foods" value="{{ $item->foods }}"
                            readonly="enabled">
                    </div>
                    <div class="form-group">
                        <label for="departure_date">Departure Date</label>
                        <input type="date" class="form-control" name="departure_date" value="{{ $item->departure_date }}"
                            readonly="enabled">
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" class="form-control" name="duration" placeholder="Ex: 1D / 2D"
                            value="{{ $item->duration }}" readonly="enabled">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" class="form-control" name="type" placeholder="Ex: Open Trip"
                            value="{{ $item->type }}" readonly="enabled">
                    </div>
                    <div class="form-group">
                        <label for="price">Price ($)</label>
                        <input type="number" class="form-control" name="price" value="{{ $item->price }}"
                            readonly="enabled">
                    </div>
                    <a href="{{ route('gallery.edit', $item->id) }}" class="btn btn-primary btn-block">
                        Edit Data
                    </a>
                    {{-- <button type="submit" class="btn btn-primary btn-block">
                        Ubah
                    </button> --}}
                </form>
            </div>
        </div>



    </div>
    <!-- /.container-fluid -->
@endsection
