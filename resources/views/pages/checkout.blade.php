@extends('layouts.checkout')

@section('title', 'Checkout')

@section('content')
    <!-- Content -->
    <main>
        <section class="section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col p-0">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Paket Travel</li>
                                <li class="breadcrumb-item">Details</li>
                                <li class="breadcrumb-item active">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 ps-lg-0">
                        <div class="card card-details">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h1>Who is Going?</h1>
                            <p>Trip to {{ $item->travel_packages->title }}, {{ $item->travel_packages->location }}</p>
                            <div class="attendeee">
                                <table class="table table-responsive-sm text-center">
                                    <thead>
                                        <tr>
                                            <td>Picture</td>
                                            <td>Name</td>
                                            <td>Nationality</td>
                                            <td>Visa</td>
                                            <td>Passport</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($item->details as $detail)
                                            <tr>
                                                <td>
                                                    <img src="https://ui-avatars.com/api/?name={{ $detail->username }}"
                                                        height="60" class="rounded-circle" />
                                                </td>
                                                <td class="align-middle">{{ $detail->username }}</td>
                                                <td class="align-middle">{{ $detail->nationality }}</td>
                                                <td class="align-middle">{{ $detail->is_visa ? '30 Days' : 'N/A' }}</td>
                                                <td class="align-middle">
                                                    {{ \Carbon\Carbon::createFromDate($detail->doe_passport) > \Carbon\Carbon::now() ? 'Active' : 'Inactive' }}
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('checkout-remove', $detail->id) }}">
                                                        <img src="{{ url('frontend/images/remove.png') }}" alt="" />
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    No Visitor
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <div class="member mt-3">
                                <h2>Add Member</h2>
                                <form class="row align-items-center g-2" method="POST"
                                    action="{{ route('checkout-create', $item->id) }}">
                                    @csrf
                                    <div class="col-auto">
                                        <label for="username" class="visually-hidden">
                                            Name
                                        </label>
                                        <input type="text" name="username" class="form-control mb-2 me-sm-2"
                                            id="username" placeholder="Username" required />
                                    </div>

                                    <div class="col-auto">
                                        <label for="nationality" class="visually-hidden">
                                            Nationality
                                        </label>
                                        <input type="text" name="nationality" class="form-control mb-2 me-sm-2"
                                            style="width: 100px" id="nationality" placeholder="Nationality" required />
                                    </div>

                                    <div class="col-auto">
                                        <label for="is_visa" class="visually-hidden">
                                            Visa
                                        </label>
                                        <select name="is_visa" id="is_visa" class="form-select mb-2 me-sm-2" required>
                                            <option value="" disabled selected hidden>VISA</option>
                                            <option value="1">30 days</option>
                                            <option value="0">N/A</option>
                                        </select>
                                    </div>

                                    <div class="col-auto">
                                        <label for="doe_passport" class="visually-hidden">
                                            DOE Passport
                                        </label>
                                        <div class="input-group mb-2 me-sm-2 ">
                                            <input type="text" class="form-control datepicker" name="doe_passport"
                                                required id="doePassport" placeholder="DOE Passport" />
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <button class="btn btn-add-now mb-2 px-4" type="submit">
                                            Add Now
                                        </button>
                                    </div>
                                </form>

                                <h3 class="mt-2 mb-0">Note</h3>
                                <p class="disclaimer mb-0">
                                    You are only able to invite member that has registered in
                                    Nomads.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-details card-right">
                            <h2>Trip Information</h2>
                            <table class="trip-information">
                                <tr>
                                    <th width="50%">Members</th>
                                    <td width="50%" class="text-end">{{ $item->details->count() }} person</td>
                                </tr>
                                <tr>
                                    <th width="50%">Additional VISA</th>
                                    <td width="50%" class="text-end">${{ $item->additional_visa }},00</td>
                                </tr>
                                <tr>
                                    <th width="50%">Trip Price</th>
                                    <td width="50%" class="text-end">${{ $item->travel_packages->price }} / person</td>
                                </tr>
                                <tr>
                                    <th width="50%">Sub Total</th>
                                    <td width="50%" class="text-end">${{ $item->transaction_total }},00</td>
                                </tr>
                                <tr>
                                    <th width="50%">Total (+Unique Code)</th>
                                    <td width="50%" class="text-end text-total">
                                        <span class="text-blue">${{ $item->transaction_total }},</span>
                                        <span class="text-orange">{{ mt_rand(0, 99) }}</span>
                                    </td>
                                </tr>
                            </table>
                            <hr />
                            <h2>Payment Instructions</h2>
                            <p class="payment-instructions">
                                Please complete your payment before to continue the wonderful
                                trip
                            </p>
                            <div class="bank">
                                <div class="bank-item pb-3">
                                    <img src="{{ url('frontend/images/ic_bank.png') }}" alt=""
                                        class="bank-image" />
                                    <div class="description">
                                        <h3>PT Nomads ID</h3>
                                        <p>
                                            0881 8829 8800
                                            <br />
                                            Bank Central Asia
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="bank-item">
                                    <img src="{{ url('frontend/images/ic_bank.png') }}" alt=""
                                        class="bank-image" />
                                    <div class="description">
                                        <h3>PT Nomads ID</h3>
                                        <p>
                                            0899 8501 7888
                                            <br />
                                            Bank HSBC
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="join-container">
                            <a href="{{ route('checkout-success', $item->id) }}"
                                class="btn w-100 btn-join-now mt-3 py-2 rounded-bottom">
                                I Have Made Payment
                            </a>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('detail', $item->travel_packages->slug) }}" class="text-muted"
                                style="text-decoration: none;">Cancel
                                Booking</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="{{ url('frontend/libraries/gijgo/css/gijgo.min.css') }}" type="text/css" />
@endpush

@push('addon-script')
    <script src="{{ url('frontend/libraries/gijgo/js/gijgo.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                uiLibrary: 'bootstrap5',
                icons: {
                    rightIcon: '<img src="{{ url('frontend/images/ic_doe.png') }}" alt="" />',
                }
            });
        });
    </script>
@endpush
