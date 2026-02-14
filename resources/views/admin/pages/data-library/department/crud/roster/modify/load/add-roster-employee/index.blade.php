@extends('admin.layouts.main-layout',["tabTitle" => config('i.service_name')." | ".pxLang($data['lang'],'breadCum.title') ])
@section('page')
    <div class="row">
        <div class="col-md-12">
            @can('add_roster_employee_load_view_view')
                <div class="">
                    @include('admin.pages.data-library.department.crud.roster.modify.load.add-roster-employee.fragments._breadcum')
                    
                    <div class="page-block-body">
                        <div class="card rounded page-block">
                            
                            <div id="defaultPage" class="table-list pages">
                                <div class="mt-2 p-2 p-md-4">
                                   @include('admin.pages.data-library.department.crud.roster.modify.load.add-roster-employee.fragments._loader')
                                </div>
                                 <div class="mt-2 p-2 p-md-4" id='add-roster-employee'></div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card rounded page-block">
                    @include('common.view.fragments.-item-403')
                </div>
            @endcan
        </div>
    </div>
@endsection
