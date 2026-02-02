@extends('employee.layouts.main-layout',["tabTitle" => config('i.service_name')." | ".pxLang($data['lang'],'breadCum.title') ])
@section('page')
   @if(Auth::user()->user_ip ==  $data['ip'])
        @include('employee.pages.attendance.entry.form.store.fragments._attendance')
   @else
       <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="card shadow-sm border-danger" style="max-width: 420px;">
            <div class="card-header bg-danger text-white fw-semibold text-center">
                Access Restricted
            </div>
            <div class="card-body text-center">
                <h5 class="card-title text-danger">IP Not Matched</h5>
                <p class="card-text text-muted">
                    Your IP address is not bound to this system or does not match our records.
                </p>

                <div class="alert alert-warning py-2 small">
                    Please contact the administrator to whitelist your IP.
                </div>

                <a href="{{ url('employee/dashboard') }}" class="btn btn-outline-danger btn-sm">
                    Go Back
                </a>
            </div>
        </div>
    </div>
   @endif
@endsection



