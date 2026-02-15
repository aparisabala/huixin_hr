<div class="mt-4 p-3">
    @can('add_roster_employee_load_view_load')
        <form id="frmLoadAddRosterEmployee" autocomplete="off">
            <input type="hidden" name="lib_department_roster_id" id="lib_department_roster_id"
                value="{{$data['roster']->id}}">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-2 shadow-card card-border">
                                <div class="form-group text-left mb-3">
                                    <label class="form-label">
                                        <b>{{pxLang($data['lang'], 'fields.employee_id', 'common.text.option_select')}}</b>
                                        <em class="required">*</em> <span id="employee_id_error"></span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="employee_id" id="employee_id">
                                            <option value=""> -- {{pxLang($data['lang'], '', 'common.text.option_select')}}
                                            </option>
                                            @foreach ($data['employees'] as $item)
                                                <option value="{{$item?->id}}">{{$item?->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3 text-end">
                                    <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-plus"></i>
                                        {{pxLang($data['lang'], '', 'common.btns.crud_load')}} </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @else
        @include('common.view.fragments.-item-403')
    @endcan
</div>