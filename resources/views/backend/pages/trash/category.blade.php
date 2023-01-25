@extends('backend.partials.app', ['title' => __('Lists Trash Category')])
@push('pluginscss')
    <link rel="stylesheet" href="{{ asset('backend') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/js/select.dataTables.min.css">
@endpush
@section('content')
    <div class="content-wrapper">
        @include('backend.partials.user.header', [
            'title' => __('Lists Trash Category'),
        ])
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <h4 class="card-title">
                                <a type="button" class="btn btn-primary btn-icon-text" onclick="restoreAll()">
                                    <i class="ti-reload btn-icon-prepend"></i>
                                    Restore All Trash
                                </a>
                            </h4>
                        </h4>
                        <div class="table-responsive">
                            {!! $dataTable->table(['id' => 'categoryTrash']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('pluginsjs')
    <script src="{{ asset('backend') }}/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{ asset('backend') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="{{ asset('backend') }}/js/dataTables.select.min.js"></script>
@endpush
@push('js')
    {!! $dataTable->scripts() !!}
    <script type="text/javascript">
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        function deleteFunc(id) {
            var id_category = id;
            Swal.fire({
                title: `Are your sure to Delete Permanent?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.value) {
                    // ajax
                    $.ajax({
                        type: "DELETE",
                        url: "category/forcedelete/" + id_category,
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id_category,
                        },
                        success: function(res) {
                            $(categoryTrash).DataTable().ajax.reload(null, false);
                            Swal.fire({
                                title: 'Deleted',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        },
                    });
                }
            });
        }

        function restoreFunc(id) {
            var id_user_restore = id;
            Swal.fire({
                title: `Are your sure to restore the data?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, restore it!",
            }).then((result) => {
                if (result.value) {
                    // ajax
                    $.ajax({
                        type: "GET",
                        url: "/trashdata/category/restore/" + id_user_restore,
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id_user_restore,
                        },
                        success: function(res) {
                            $(categoryTrash).DataTable().ajax.reload(null, false);
                            Swal.fire({
                                title: 'Success Restore',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        },
                    });
                }
            });
        }

        function restoreAll() {
            var urlRestoreAll = "{{ route('restoreall.category') }}";
            Swal.fire({
                title: `Are your sure to Restore All Data?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, restore it!",
            }).then((result) => {
                if (result.value) {
                    // ajax
                    $.ajax({
                        type: "GET",
                        url: urlRestoreAll,
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(res) {
                            $(categoryTrash).DataTable().ajax.reload(null, false);
                            Swal.fire({
                                title: 'Success Restore',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        },
                    });
                }
            });
        }
    </script>
@endpush
