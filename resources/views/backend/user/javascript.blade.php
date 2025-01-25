@push('after-script')
    <script type="text/javascript">
        var table = ".data-table";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $('#role_id').select2({
        //     dropdownParent: "#modalUser",
        //     placeholder: "Select",
        //     allowClear: true,
        //     ajax: {
        //         url: "{{ route('user.getRoles') }}",
        //         dataType: 'json',
        //         data: function(params) {
        //             var queryParameters = {
        //                 q: params.term
        //             }
        //             return queryParameters;
        //         },
        //         processResults: function(data) {
        //             return {
        //                 results: data.data
        //             };
        //         }
        //     }
        // });

        $(function() {
            table = $(table).DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.table') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'roles.role_name',
                        name: 'roles.role_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            initSelect()
        });


        initSelect = () => {
            $.ajax({
                url: "{{ route('user.getRoles') }}",
                success: (response) => {
                    HELPER.setChangeCombo({
                            data: response.data,
                            el: 'role_id',
                            valueField: 'id',
                            displayField: 'text',
                            select2: true,
                            placeholder: 'Pilih Role',
                            dropdownParent: "#modalUser"
                        })
                },
            })
        }

        onEdit = (id) => {
            $("#user_id").val(id);
            $.ajax({
                url: "{{ route('user.show') }}",
                data: {
                    id
                },
                method: 'POST',
                success: function(data) {
                    $("#name").val(data.data.name);
                    $("#username").val(data.data.username);
                    $("#email").val(data.data.email);
                    $("#password").val(data.data.password);
                    $("#password2").val(data.data.password2);
                    $("#role_id").val(data.data.role_id).change();
                    $("#modalUser").modal('show');
                },
                error: function() {
                    Swal.fire({
                        success: false,
                        title: "Error",
                        message: "System error!"
                    });
                }
            });
        }

        onSave = () => {
            $.ajax({
                data: $('#form-user').serialize(),
                url: "{{ route('user.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    if (data.status === 'success') {
                        Swal.fire({
                            title: 'Sukses!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#form-user').trigger("reset");
                                $("#modalUser").modal('hide');
                                $("#user_id").val('');

                                table.draw();
                            }
                        });
                    } else if (data.status === 'info') {
                        Swal.fire({
                            success: false,
                            title: 'Password tidak sama',
                            message: '',
                            icon: 'info',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                table.draw();
                            }
                        });
                    }
                },
                error: function(err) {
                    console.log('Error:', err);
                    let message = err?.responseJSON?.message ?? 'System Error';
                    Swal.fire({
                        success: false,
                        title: message,
                    });
                    table.draw()
                }
            });
        };


        onDelete = (id) => {
            Swal.fire({
                icon: 'warning',
                title: 'Apakah anda yakin ingin menghapus data ini?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('user.destroy') }}",
                        data: {
                            id
                        },
                        type: "POST",
                        success: function(data) {
                            Swal.fire('Deleted data successfully');
                            table.draw()
                        }
                    });
                }
            })
        }
    </script>
@endpush
