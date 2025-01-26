@push('after-script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(() => {
            getDonatur()
        })

        getDonatur = () => {
            $('#donatur_id').select2({
                placeholder: "Pilih Donatur",
                allowClear: true,
                ajax: {
                    url: "{{ route('transaction.getDonatur') }}",
                    dataType: 'json',
                    data: function(params) {
                        var queryParameters = {
                            q: params.term
                        }
                        return queryParameters;
                    },
                    processResults: function(data) {
                        return {
                            results: data.data
                        };
                    }
                }
            });
        }

        onSelectDonatur = () => {
            let donatur_id = $("#donatur_id").val()
            if (!donatur_id) {
                Swal.fire({
                    title: "Gagal",
                    text: "Donatur belum dipilih",
                    icon: "error"
                });
                return
            }

            $.ajax({
                url: "{{ route('transaction.detailDonatur') }}",
                method: "POST",
                data: {
                    id: donatur_id
                },
                success: (response) => {
                    $("#biodata").removeClass('d-none').html(populateBiodata(response.data))

                    processList()
                },
                error: (err) => {
                    let message = err?.responseJSON?.message ?? 'System Error';
                    Swal.fire({
                        title: "Gagal",
                        text: message,
                        icon: "error"
                    });
                }
            })
        }

        populateBiodata = (data) => {
            var html = `<div class="row">
                    <div class="col">
                        <p>Nama : ${data.name}</p>
                        <p>Alamat : ${data.address}</p>
                        <p>No HP : ${data.phone}</p>
                    </div>
                </div>`

            return html
        }

        processList = () => {
            $.ajax({
                url: "{{ route('transaction.getCategory') }}",
                success: (res) => {
                    $("#fix-body").html(populateTable(res.data['tetap']))
                    // $("#free-body").html(populateTable(res.data['bebas']))
                    $("#transaction-container").removeClass('d-none')

                    HELPER.setChangeCombo({
                        data: res.data['bebas'],
                        el: 'item_id',
                        valueField: 'id',
                        displayField: 'name',
                        valueAdd: 'type',
                        select2: true,
                        placeholder: 'Pilih Item',
                        dropdownParent: "#modalAddItem"
                    })

                    $("#footer-action").removeClass('d-none')
                }
            })
        }

        populateTable = (data, type) => {
            let html = ''
            $.each(data, (i, v) => {
                html += trData(v, i + 1)
            })

            return html
        }

        trData = (data, index) => {
            let dataItem = {
                'index': index,
                'item_id': data.id,
                'name': data.name,
                'amount': data.amount,
                'type': data.type
            }

            let html = `
                    <tr data-id="${data.id}" data-index=${index}>
                        <input type="hidden" value="${data.id}" name="item[${data.id}-${index}][id]">
                        <input type="hidden" value="${data.amount}" name="item[${data.id}-${index}][amount]">
                        <td>${index}</td>
                        <td>${data.name}</td>
                        <td>${data.amount ? HELPER.toRp(data.amount) : '-'}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-secondary ${data.type == 1 ? 'd-none' : 'd-none'}" data-item=${JSON.stringify(dataItem)} onclick="onEditItem(this)"><i class="fa fa-pen"></i></button>
                            <button type="button" class="btn btn-sm btn-danger" data-item=${JSON.stringify(dataItem)} onclick="onDeleteItem(this)"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
            `
            return html
        }

        onSave = () => {
            let formData = new FormData($('[name="formTransaction"]')[0])
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Apakah anda yakin menyimpan transaksi?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Simpan"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('transaction.store') }}",
                        data: formData,
                        method: "POST",
                        contentType: false,
                        processData: false,
                        success: (response) => {
                            Swal.fire({
                                title: "Sukses",
                                text: "Transaksi berhasil disimpan",
                                icon: "success"
                            });

                            Swal.fire({
                                title: "Sukses",
                                text: "Transaksi berhasil disimpan",
                                icon: "success",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Print!"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "transaction/print/" + response
                                        .data.id
                                } else {
                                    location.reload()
                                }
                            });
                        },
                        error: (err) => {
                            Swal.fire({
                                title: "Gagal",
                                text: "Transaksi gagal diproses",
                                icon: "error"
                            });
                        }
                    })
                }
            });
        }

        addItem = (type) => {
            toggleModalItem()
        }

        toggleModalItem = (show = true) => {
            let modal = show ? 'show' : 'hide'
            if (!show) resetFormItem()
            $("#modalAddItem").modal(modal)
        }

        onAddItem = () => {
            let id = $("#formAddItem #item_id").find(':selected').val(),
                text = $("#formAddItem #item_id").find(':selected').text(),
                type = $("#item_id").find(':selected').data('add'),
                amount = $("#formAddItem #amount").val(),
                tbody = $("#free-body"),
                index = tbody.children().length,
                data = {
                    id: id,
                    name: text,
                    amount: amount,
                    type: type
                }

            $("#free-body").append(trData(data, index + 1))
            toggleModalItem(false)
        }

        onEditItem = (el) => {
            let data = $(el).data('item')
            HELPER.populateForm('#formAddItem', data)
            toggleModalItem()
        }

        onDeleteItem = (el) => {
            let data = $(el).data('item')
            let bodyEl = data.type == 1 ? "fix-body" : "free-body"

            $(`#${bodyEl}`).find(`[data-index='${data.index}']`).remove()
        }

        resetFormItem = () => {
            HELPER.resetForm('#formAddItem')
        }
    </script>
@endpush
