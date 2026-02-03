@extends('employee.layouts.main-layout', ['tabTitle' => config('i.service_name') . ' | ' . pxLang($data['lang'], 'breadCum.title')])
@section('page')
    @if (request()->cookie('device_token'))
        @include('employee.pages.attendance.entry.form.store.fragments._attendance')
    @else
        <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
            <div class="card shadow-sm border-danger" style="max-width: 420px;">
                <div class="card-header bg-danger text-white fw-semibold text-center">
                    Access Restricted
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title text-danger">This device is not bind yet</h5>
                    <p class="card-text text-muted">
                        Your IP address is not bound to this system or does not match our records.
                    </p>

                    <div class="alert alert-warning py-2 small">
                        Please contact the administrator to whitelist your IP.
                    </div>
                    <div class="card p-2">
                        <div class="d-flex">
                            <img class="rounded-circle header-profile-user" src="{{ getRowImage(Auth::user(), '80X80') }}"
                                alt="Header Avatar" style="width: 120px; height: 120px;">
                        </div>
                        <div class="d-flex">
                            <p class="me-2"> User Name: </p>
                            <p> {{ Auth::user()->name }} </p>
                        </div>
                        <div class="d-flex">
                            <p class="me-2"> ID: </p>
                            <p> {{ Auth::user()->employee_id }} </p>
                        </div>
                        <div class="d-flex">
                            <p class="me-2"> Mobile Number: </p>
                            <p> {{ Auth::user()->mobile_number }} </p>
                        </div>
                        <div class="d-flex">
                            <p class="me-2">Email: </p>
                            <p> {{ Auth::user()->email }} </p>
                        </div>
                        <span class="btn btn-outline-danger btn-sm" id="bindDeviceIp" data-id="{{ Auth::user()->id }}">Bind
                            Now
                            </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
