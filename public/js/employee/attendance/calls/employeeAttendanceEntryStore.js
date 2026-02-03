$(document).ready(function () {
    PX?.utils?.fixHeight('fix-att-card', 'fix-att-card', 0, 7);
    if ($('#frmEmployeeAttendanceEntryStore').length > 0) {
        $('#image').imageCropper({
            outputWidth: 1024,
            outputHeight: 1024,
            mimeType: 'image/jpeg',
            boundingBox: { width: 250, height: 250 },
            quality: .5
        });
        sendTiming('frmEmployeeAttendanceEntryStore', 'in')
    }

    if ($('#frmEmployeeAttendanceSignOut').length > 0) {
        $('#out_image').imageCropper({
            outputWidth: 1024,
            outputHeight: 1024,
            mimeType: 'image/jpeg',
            boundingBox: { width: 250, height: 250 },
            quality: .5
        });
        sendTiming('frmEmployeeAttendanceSignOut', 'out')
    }

    $("#bindDeviceIp").on("click", function () {
        let id = $(this).attr('data-id');
        $.confirm({
            title: 'Input admin password',
            content:
                '<div class="form-group">' +
                '<label>Password</label>' +
                '<input type="password" placeholder="Admin Password" class="password form-control" required />' +
                '</div>',
            buttons: {
                submit: {
                    text: 'Submit',
                    btnClass: 'btn-primary',
                    action: function () {
                        var password = this.$content.find('.password').val();
                        if (!password) {
                            $.alert('Password required');
                        }
                        PX?.ajaxRequest({
                            element: 'elment',
                            dataType: 'json',
                            body: { password, id },
                            type: 'request',
                            script: 'employee/attendance/entry/bind',
                            afterSuccess: {
                                type: 'inflate_redirect_response_data',
                            }
                        });
                        return false;
                    }
                },
                cancel: function () {
                    //close
                },
            },
            onContentReady: function () {
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    })

});

function sendTiming(frm, type) {
    let rules = {};
    PX?.ajaxRequest({
        element: frm,
        validation: true,
        beforeSend: function (op, callback) {
            if (!navigator.geolocation) {
                showAlert("Location Error", "Geolocation is not supported by this browser.");
                return 0;
            }
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    let newbody = op.body;
                    newbody.append('latitude', latitude);
                    newbody.append('langututute', longitude);
                    console.log(lang);
                    callback({ ...op, body: newbody });
                },
                function (error) {
                    let newbody = op.body;
                    newbody.append('latitude', 28.476169);
                    newbody.append('longitude', 77.091228);
                    callback({ ...op, body: newbody });
                },
                {
                    enableHighAccuracy: false,
                    timeout: 5000,
                    maximumAge: 60000
                }
            );

        },
        script: type === 'in' ? 'employee/attendance/entry/store' : 'employee/attendance/entry/update',
        rules,
        afterSuccess: {
            type: 'inflate_redirect_response_data',
        }
    });
}
