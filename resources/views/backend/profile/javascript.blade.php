@push('after-script')
    <script type="text/javascript">
        $(() => {
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            HELPER.disableInput('#formBiodata');
            $("#role_id").select2();
            init();
        });

        init = async () => {
            await HELPER.unblock(100);
        }

        onEdit = () => {
            HELPER.enableInput('#formBiodata');
            $("#btnSaveBio").show();
            $("#btnEdit").hide();
            $("#btnCancel").show();
        }

        onSaveBiodata = () => {
            HELPER.block();
            $.ajax({
                data: $('#formBiodata').serialize(),
                url: "{{ route('profile.update') }}",
                type: "PATCH",
                dataType: 'json',
                success: function(data) {
                    $('#formBiodata').trigger("reset");
                    $("#btnSaveBio").hide();
                    HELPER.showMessage({
                        success: true,
                        title: 'Success',
                        message: 'Update profile successfully',
                        callback: function() {
                            window.location.reload();
                        }
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                    Swal.fire({
                        success: false,
                        title: "Error",
                        message: "System error!"
                    });
                }
            });
        }

        onCancel = () => {
            $("#btnEdit").show();
            $("#btnCancel").hide();
            $("#btnSaveBio").hide();
            HELPER.disableInput('#formBiodata');

        }
        onChangePasword = () => {
            $.ajax({
                data: $('#formUpdatePassword').serialize(),
                url: "{{ route('profile.updatePassword') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    HELPER.showMessage({
                        success: true,
                        title: 'Success',
                        message: 'Password changed successfull',
                        callback: function() {
                            window.location.reload();
                        }
                    });
                },
                error: function(data) {
                    Swal.fire({
                        success: false,
                        title: "Error",
                        text: "Failed!"
                    });
                }
            });
        }

        onInputAvatar = () => {
            $("#avatar").click();
        }

        $("#avatar").change(function() {
            var fd = new FormData();
            var files = this.files[0];
            fd.append('avatar', files);

            HELPER.block();
            HELPER.ajax({
                url: "{{ route('profile.updateAvatar') }}",
                data: fd,
                type: "POST",
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        HELPER.showMessage({
                            success: true,
                            title: 'Sukses',
                            message: 'Foto profile berhasil diganti'
                        })
                        HELPER.reloadPage();

                    } else {
                        HELPER.showMessage({
                            success: false,
                            title: 'Gagal',
                            message: response.message
                        })
                    }

                },
                complete: function(response) {
                    HELPER.unblock();
                }
            });
        });
    </script>
@endpush
