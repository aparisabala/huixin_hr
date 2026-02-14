<div class="bg-info pl-2 page-fragment-bar">
    <span class="text-light"> <a href=""><span class="badge badge-info cursor-pointer"> <i class='fa-solid fa-arrow-left fs-16'></i></span></a> <span class="pt-1">{{pxLang($data['lang'],'add')}}  </span> </span>
</div>
<div class="mt-4 p-3">
    {{-- @can('employee_task_crud_store') --}}
    <form id="frmStoreEmployeeTask" autocomplete="off" style="width: 100%;">
        <div class="card p-2 shadow-card card-border">
            <div class="form-group text-left mb-3">
                <label class="form-label">
                    <b>{{pxLang($data['lang'],'fields.name')}}</b> <em class="required">*</em> 
                    <span id="name_error"></span>
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" name="name" id="name">
                </div>
            </div>
            <div class="form-group text-left mb-3">
                <label class="form-label">
                    <b>{{pxLang($data['lang'],'fields.short_description')}}</b> <em class="required">*</em> 
                    <span id="short_description_error"></span>
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" name="short_description" id="short_description">
                </div>
            </div>
            <div class="form-group text-left mb-3">
                <label class="form-label">
                    <b>{{pxLang($data['lang'],'fields.long_description')}}</b> <em class="required">*</em> 
                    <span id="long_description_error"></span>
                </label>
                <div class="input-group">
                    <textarea class="form-control long_description" name="long_description" id="long_description"></textarea>
                </div>
            </div>
            <div class="mb-3 mt-3 text-end">
                <button class="btn btn-info btn-sm" type="submit">
                    <i class="fa fa-plus"></i> {{pxLang($data['lang'],'','common.btns.crud_action_add')}}
                </button>
            </div>
        </div>
    </form>
    {{-- @else
        @include('common.view.fragments.-item-403')
    @endcan --}}
</div>

