@extends('layouts.app')

@section('title', 'Detail Travel')

@section('content')
    <main>
        <section class="section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col p-0">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Paket Travel</li>
                                <li class="breadcrumb-item active">Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 ps-lg-0">
                        <div class="card card-details">
                            <h1>{{ $item->title }}</h1>
                            <p>{{ $item->location }}</p>
                            @if ($item->galleries->count())
                                <div class="gallery">
                                    <div class="xzoom-container">
                                        <img src="{{ Storage::url($item->galleries->first()->image) }}" class="xzoom"
                                            id="xzoom-default" width="650" height="350"
                                            xoriginal="{{ Storage::url($item->galleries->first()->image) }}" />
                                    </div>
                                    <div class="xzoom-thumbs d-flex justify-content-center">
                                        @foreach ($item->galleries as $gallery)
                                            <a href="{{ Storage::url($gallery->image) }}" style="text-decoration: none; ">
                                                <img src="{{ Storage::url($gallery->image) }}" class="xzoom-gallery"
                                                    width="131" height="80"
                                                    xpreview="{{ Storage::url($gallery->image) }}" />
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <h2>Tentang Wisata</h2>
                            <p style="text-align: justify;">
                                {!! $item->about !!}
                                {{-- agar tidak ada yg hilang --}}
                            </p>
                            <div class="features d-flex justify-content-evenly">
                                <div>
                                    <img src="{{ url('frontend/images/ic_event.png') }}" alt=""
                                        class="features-image" style="justify-content: center;" />
                                    <div class="description">
                                        <h3>Featured Event</h3>
                                        <p>{{ $item->featured_event }}</p>
                                    </div>
                                </div>
                                {{-- <div class="vr col-md-1" style="margin-left: -10px; borderWidth: 1"></div> --}}
                                <div class="border-start"></div>

                                <div>
                                    <img src="{{ url('frontend/images/ic_language.png') }}" alt=""
                                        class="features-image" style="justify-content: center;" />
                                    <div class="description">
                                        <h3>Language</h3>
                                        <p>{{ $item->language }}</p>
                                    </div>
                                </div>
                                {{-- <div class="vr col-md-1" style="margin-left: -10px; borderWidth: 1"></div> --}}
                                <div class="border-start"></div>

                                <div>
                                    <img src="{{ url('frontend/images/ic_foods.png') }}" alt=""
                                        class="features-image" style="justify-content: center;" />
                                    <div class="description">
                                        <h3>Foods</h3>
                                        <p>{{ $item->foods }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-details card-right">
                            <h2>Members are going</h2>
                            <div class="members my-2">
                                <img src="{{ url('frontend/images/member-1.png') }}" class="members-image me-1" />
                                <img src="{{ url('frontend/images/member-2.png') }}" class="members-image me-1" />
                                <img src="{{ url('frontend/images/member-3.png') }}" class="members-image me-1" />
                                <img src="{{ url('frontend/images/member-4.png') }}" class="members-image me-1" />
                                <img src="{{ url('frontend/images/member-5.png') }}" class="members-image me-1" />
                            </div>
                            <hr />
                            <h2>Trip Information</h2>
                            <table class="trip-information">
                                <tr>
                                    <th width="50%">Date of Departure</th>
                                    <td width="50%" class="text-end">
                                        {{ \Carbon\Carbon::create($item->departure_date)->format('F d, Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">Duration</th>
                                    <td width="50%" class="text-end">{{ $item->duration }}</td>
                                </tr>
                                <tr>
                                    <th width="50%">Type</th>
                                    <td width="50%" class="text-end">{{ $item->type }}</td>
                                </tr>
                                <tr>
                                    <th width="50%">Price</th>
                                    <td width="50%" class="text-end">${{ $item->price }},00 / person</td>
                                </tr>
                            </table>
                        </div>
                        <div class="join-container">
                            @auth
                                <form action="{{ route('checkout-process', $item->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn w-100 btn-join-now mt-3 py-2 rounded-bottom">
                                        Join Now
                                    </button>
                                </form>
                            @endauth
                            @guest
                                <a href="{{ route('login') }}" class="btn w-100 btn-join-now mt-3 py-2 rounded-bottom">
                                    Join Now
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/xzoom.css') }}" />
@endpush

@push('addon-script')
    <script src="{{ url('frontend/libraries/xzoom/xzoom.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".xzoom, .xzoom-gallery").xzoom({
                zoomWidth: 550,
                title: false,
                tint: "#333",
                Xoffset: 15,
            });
        });
    </script>
@endpush
