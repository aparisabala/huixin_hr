<div class="bg-info pl-2 page-fragment-bar">
    <span class="text-light">
        <a href="{{ url()->previous() }}">
            <span class="badge badge-info cursor-pointer">
                <i class="fa-solid fa-arrow-left fs-16"></i>
            </span>
        </a>
        <span class="pt-1">
            {{ pxLang($data['lang'],'update') }}
        </span>
    </span>
</div>

<div class="mt-4 p-3">
@can('lib_department_roster_employee_crud_edit')

<form id="frmUpdateLibDepartmentRosterEmployee" autocomplete="off">
    @method('PATCH')

    {{-- PATCH ID --}}
    <input type="hidden"
           name="id"
           id="patch_id"
           value="{{ $data['item']?->id }}">

    {{-- Roster ID --}}
    <input type="hidden"
           name="lib_department_rosters_id"
           value="{{ $data['item']?->lib_department_rosters_id }}">

    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-4">
                    <div class="card p-2 shadow-card card-border">

                        {{-- Employee --}}
                        <div class="form-group text-left mb-3">
                            <label class="form-label">
                                <b>{{ pxLang($data['lang'],'fields.lib_employees_id') }}</b>
                                <em class="required">*</em>
                                <span id="lib_employees_id_error"></span>
                            </label>

                            <select name="lib_employees_id"
                                    id="lib_employees_id"
                                    class="form-control">
                                <option value="">-- Select Employee --</option>
                                @foreach($data['employees'] as $employee)
                                    <option value="{{ $employee->id }}"
                                        @selected($employee->id == $data['item']?->lib_employees_id)>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- In Time --}}
                        <div class="form-group text-left mb-3">
                            <label class="form-label">
                                <b>{{ pxLang($data['lang'],'fields.in_time') }}</b>
                                <span id="in_time_error"></span>
                            </label>

                            <input type="text"
                                   class="form-control dp-time"
                                   name="in_time"
                                   id="in_time"
                                   value="{{ $data['item']?->in_time }}">
                        </div>

                        {{-- Out Time --}}
                        <div class="form-group text-left mb-3">
                            <label class="form-label">
                                <b>{{ pxLang($data['lang'],'fields.out_time') }}</b>
                                <span id="out_time_error"></span>
                            </label>

                            <input type="text"
                                   class="form-control dp-time"
                                   name="out_time"
                                   id="out_time"
                                   value="{{ $data['item']?->out_time }}">
                        </div>

                        {{-- Off Day --}}
                        <div class="form-group text-left mb-3">
                            <div class="form-check">
                                <input type="checkbox"
                                       class="form-check-input"
                                       name="off_day"
                                       id="off_day"
                                       value="1"
                                       {{ $data['item']?->off_day ? 'checked' : '' }}>
                                <label class="form-check-label" for="off_day">
                                    {{ pxLang($data['lang'],'fields.off_day') }}
                                </label>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="mb-3 mt-3 text-end">
                            <button class="btn btn-info btn-sm" type="submit">
                                <i class="fa fa-save"></i>
                                {{ pxLang($data['lang'],'','common.btns.crud_action_update') }}
                            </button>
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
