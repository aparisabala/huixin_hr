<form id="frmUpdateUserSettings" autocomplete="off">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <div class="form-group text-left mb-3">
                        <label class="form-label"> <b>{{ Lang::get($data['lang'].'.fields.user_ip') }}</b> <em class="required">*</em> <span id="user_ip_error"></span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="user_ip" id="user_ip">
                        </div>
                    </div>
                    <div class="mb-3 mt-3 text-end">
                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i>  {{pxLang($data['lang'],'','common.btns.crud_action_update')}} </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
