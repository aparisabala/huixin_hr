<form id="frmSaveAddRosterEmployee" autocomplete="off">
    @csrf
    <input type="hidden" name="lib_department_roster_id" value="{{ $data['roster']->id }}">
    <input type="hidden" name="employee_id" value="{{ $data['employee']->id }}">
    <div class="card p-2 shadow-card card-border">
        <div class="form-group text-left mb-3">
             <h6 class="mb-2">
                <i class="fas fa-calendar-alt me-1"></i>
                Roster Dates for <strong>{{ $data['employee']->name }}</strong>
                <span class="text-muted ms-2">({{ $data['roster']->start_date }} to {{ $data['roster']->end_date }})</span>
            </h6>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead class="bg-info text-white">
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>Date</th>
                            <th>Day</th>
                            <th>Shift</th>
                            <th class="text-center">Is Off Day?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['dates'] as $index => $dateItem)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $dateItem['date'] }}</td>
                                <td>{{ $dateItem['day_name'] }}</td>
                                <td>
                                    <select name="shifts[{{ $dateItem['date'] }}]" class="form-control">
                                        <option value="">Select Shift</option>
                                        @foreach ($data['shifts'] as $shift)
                                            <option value="{{ $shift->id }}"
                                                {{ (isset($dateItem['shift_id']) && $dateItem['shift_id'] == $shift->id) ? 'selected' : '' }}>
                                                {{ $shift->name }}
                                                ({{ \Carbon\Carbon::parse($shift->start_time)->format('g:i A') }} -
                                                {{ \Carbon\Carbon::parse($shift->end_time)->format('g:i A') }})
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input" type="checkbox" name="off_days[]"
                                            value="{{ $dateItem['date'] }}" id="off_day_{{ $index }}"
                                            {{ (isset($dateItem['is_off_day']) && $dateItem['is_off_day']) ? 'checked' : '' }}>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3 text-end">
                <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </div>
</form>