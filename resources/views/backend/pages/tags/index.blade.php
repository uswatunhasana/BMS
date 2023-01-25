@extends('backend.partials.app', ['title' => __('Users List')])
@push('pluginscss')
<link rel="stylesheet" href="{{ asset('backend') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{ asset('backend') }}/vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/js/select.dataTables.min.css">
@endpush
@section('content')
<div class="content-wrapper">
  @include('backend.partials.user.header', [
  'title' => __('Users Data'),
  ])
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive" >
            {!! $dataTable->table(['id' => 'userTrash']) !!}
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
<script src="{{ asset('backend') }}/js/dashboard.js"></script>
{!! $dataTable->scripts() !!}
<script type="text/javascript">
  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  })
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function deleteFunc(id) {
    var id_user = id;
    Swal.fire({
      title: `Are your sure to Delete?`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        // ajax
        $.ajax({
          type: "DELETE",
          url: '/users/' + id_user,
          data: {
            "_token": "{{ csrf_token() }}",
            "id": id_user,
          },
          success: function(res) {
            $(userTrash).DataTable().ajax.reload(null, false);
          }
        });
        Swal.fire({
          title: 'Deleted',
          icon: 'success',
          showConfirmButton: false,
          timer: 1500
        })
      }
    })
  }
</script>


@endpush