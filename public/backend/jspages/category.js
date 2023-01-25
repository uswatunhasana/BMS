$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

(function deleteFunc(id) {
    var id_category = id;
    Swal.fire({
        title: `Are your sure to Delete?`,
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
                url: "/category/" + id_category,
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id_category,
                },
                success: function (res) {
                    var oTable = $(".yajra-datatable").dataTable();
                    oTable.fnDraw(false);
                },
            });
            Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
    });
})(jQuery)

// $("#store").submit(function (e) {
//     e.preventDefault();
//     $('#addButton').attr("disabled", true);
//     let data = Object.fromEntries(new FormData(e.target));
//     data = JSON.stringify(data);
//     $.ajax({
//         type: "post",
//         url: $(this).attr("action"),
//         data: data,
//         dataType: "JSON",
//         cache: false,
//         contentType: false,
//         processData: false,
//         success: (data) => {
//             $("#addModal").modal("hide");
//             var oTable = $(".yajra-datatable").dataTable();
//             oTable.fnDraw(false);
//             $(".modal-backdrop").remove();
//         },
//         error: function (data) {
//             console.log(data);
//         },
//     });
// });
