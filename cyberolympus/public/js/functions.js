$(document).ready(function () {
    $.ajax({
        url: 'http://cyberolympus.test/api/customers',
        method: 'GET',
        dataType: 'json',
        success: res => {
            console.log(res);
            $('#tblcustomers').html('')
            $('#pagination').html(res.pagination);
            $.each(res.data.data, function (i, v) {
                $("#tblcustomers").append($('<tr>')
                    .append($('<td>').append(`${v.nama}`))
                    .append($('<td>').append(`${v.alamat}`))
                    .append($('<td>').append(`${v.nomor_telepon}`))
                    .append($('<td>').append(`${v.tanggal_registrasi}`))
                    .append($('<td>').append(`<button class="btn btn-danger btn-hapus" data-id="${v.id}" >Delete</button>
                    <button class="btn btn-success btn-edit" data-toggle="modal" data-id="${v.id}" data-target="#exampleModalCenter" onclick="editCustomer($(this).data('id'))">Edit</button>
                    `))
                )
            })
        }
    })
})

$(document).on('click', '.pagination a', function (event) {
    event.preventDefault();
    // console.log(event);
    var page = $(this).attr('href').split('page=')[1];
    // console.log(page);
    nexthalaman(page);
});


function nexthalaman(page) {
    // console.log("http://cyberolympus.test/api/customers/pagination?page=" + page);
    $.ajax({
        url: "http://cyberolympus.test/api/pagination?page=" + page,
        method: 'post',
        success: function (res) {
            console.log(res);
            $('#tblcustomers').html('')
            $('#pagination').html(res.pagination);
            $.each(res.data.data, function (i, v) {
                $("#tblcustomers").append($('<tr>')
                    .append($('<td>').append(`${v.nama}`))
                    .append($('<td>').append(`${v.alamat}`))
                    .append($('<td>').append(`${v.nomor_telepon}`))
                    .append($('<td>').append(`${v.tanggal_registrasi}`))
                    .append($('<td>').append(`<button class="btn btn-danger btn-hapus" data-id="${v.id}" >Delete</button>
                    <button class="btn btn-success btn-edit" data-id="${v.id}" onclick="editCustomer($(this).data('id'))">Edit</button>`))
                )
            })
        }
    });
}


$(document).on('click', '.updateCustomer', function (e) {
    e.preventDefault();
    // console.log(e);
    let nama = $('#nama2').val();
    let alamat = $('#alamat2').val();
    let nomor_telepon = $('#nomor_telepon2').val();
    let id = $('#idcustomer').val();
    console.log(id)
    $.ajax({
        method: 'PUT',
        url: `http://cyberolympus.test/api/customers/${id}`,
        data: {
            nama,
            alamat,
            nomor_telepon
        },
        dataType: "json",
        success: res => {
            console.log(res);
            Swal.fire({
                icon: 'success',
                title: res.message,
            }).then((res) => {
                // $('#modal').modal('hide');
                location.reload()
            })
        },
        error: err => {
            console.log(err);
        }
    })
})

$('#search').on('keyup', function () {
    var keyword = $('#search').val();
    if(keyword.length > 0) {
    search();
    } else {
        $.ajax({
            url: 'http://cyberolympus.test/api/customers',
            method: 'GET',
            dataType: 'json',
            success: res => {
                console.log(res);
                $('#tblcustomers').html('')
                $('#pagination').html(res.pagination);
                $.each(res.data.data, function (i, v) {
                    $("#tblcustomers").append($('<tr>')
                        .append($('<td>').append(`${v.nama}`))
                        .append($('<td>').append(`${v.alamat}`))
                        .append($('<td>').append(`${v.nomor_telepon}`))
                        .append($('<td>').append(`${v.tanggal_registrasi}`))
                        .append($('<td>').append(`<button class="btn btn-danger btn-hapus" data-id="${v.id}" >Delete</button>
                        <button class="btn btn-success btn-edit" data-toggle="modal" data-id="${v.id}" data-target="#exampleModalCenter" onclick="editCustomer($(this).data('id'))">Edit</button>
                        `))
                    )
                })
            }
        })
    }
});
search();
function search() {
    var keyword = $('#search').val();
    // console.log(keyword);
    $.ajax({
        url: 'http://cyberolympus.test/api/searchCustomer',
        method: 'POST',
        data: {
            keyword
        },
        dataType: 'json',
        success: function (res) {
            table_post_row(res);
            // console.log(res);
        }
    })
}
// table row with ajax
function table_post_row(res) {
    console.log(res);
    let html = ''
    if (res.data.length <= 0) {
        html += `
       <tr>
          <td colspan="5">Data tidak ditemukan.</td>
      </tr>`;
      $('#pagination').html('');
    }
    for (let i = 0; i < res.data.length; i++) {
        html += `
        <tr>
              <td>`+ res.data[i].nama + `</td>
               <td>`+ res.data[i].alamat + `</td>
               <td>`+ res.data[i].nomor_telepon + `</td>
               <td>`+ res.data[i].tanggal_registrasi + `</td>
               <td>`+ res.data[i].alamat + `</td>
               <td><button class="btn btn-danger btn-hapus" data-id="${res.data[i].id}" >Delete</button>
               <button class="btn btn-success btn-edit" data-toggle="modal" data-id="${res.data[i].id}" data-target="#exampleModalCenter" onclick="editCustomer($(this).data('id'))">Edit</button></td>
        </tr>`;
    }
    $('#pagination').html(res.pagination);
    $('#tblcustomers').html(html)
}


function editCustomer(id) {
    // console.log(id);
    $("#exampleModalCenter").modal('show');
    $.ajax({
        method: 'GET',
        dataType: 'json',
        url: `http://cyberolympus.test/api/customers/${id}`,
        data: {
            id
        },
        success: res => {
            console.log(res);
            $("#nama2").val(res.data.nama);
            $("#idcustomer").val(res.data.id);
            $("#alamat2").val(res.data.alamat);
            $("#nomor_telepon2").val(res.data.nomor_telepon);
        }
    })
}


$('#cari').click(function (e) {
    e.preventDefault();
    let tanggalawal = $('#tanggalawal').val();
    let tanggalakhir = $('#tanggalakhir').val();
    $.ajax({
        url: 'http://cyberolympus.test/api/cari',
        method: 'POST',
        dataType: 'json',
        data: {
            tanggalawal,
            tanggalakhir
        },
        success: res => {
            $('#tblcustomers').html('')
            $('#pagination').html(res.pagination);
            $.each(res.data.data, function (i, v) {
                $("#tblcustomers").append($('<tr>')
                    .append($('<td>').append(`${v.nama}`))
                    .append($('<td>').append(`${v.alamat}`))
                    .append($('<td>').append(`${v.nomor_telepon}`))
                    .append($('<td>').append(`${v.tanggal_registrasi}`))
                    .append($('<td>').append(`<button class="btn btn-danger btn-hapus" data-id="${v.id}" >Delete</button>
                    <button class="btn btn-success btn-edit" data-toggle="modal" data-id="${v.id}" data-target="#exampleModalCenter" onclick="editCustomer($(this).data('id'))">Edit</button>
                    `))
                )
            })
        }
    })

})


$('#tambah').click(function () {
    $('.modal-footer').html('')
    $('.modal-footer').append(`
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
        <button type="button" class="btn btn-primary" id="store">Save</button> 
    `)
})

$(document).on('click', '.btn-hapus', function (e) {
    // e.preventDefault();
    let id = $(this).attr('data-id');
    // console.log(id);
    swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Data Akan Dihapus!",
        icon: "warning",
        title: "Apakah Anda Yakin?",
        confirmButtonText: 'Delete',
        confirmButtonColor: '#32CD32',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // console.log($(this).attr('data-id'));
            // del($(this).attr('data-id'))
            // console.log(id);
            $.ajax({
                url: 'http://cyberolympus.test/api/customers/' + id,
                method: 'DELETE',
                dataType: 'json',
                success: function (res) {
                    // console.log(res);
                    Swal.fire({
                        icon: 'success',
                        title: res.message,
                    }).then((res) => {
                        // $('#modal').modal('hide');
                        location.reload()
                    })
                },

            })

        }
    });
})

function del(id) {
    $.ajax({
        url: 'http://cobaapp.test/api/book/' + id,
        type: 'DELETE',
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        success: res => {
            console.log(res);
            // return res
        },
        error: err => {
            // console.log(err.responseJSON.errors[0]);
            $.each(err.responseJSON.errors, function (i, v) {
                // console.log(v[0]);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: v,
                })
            })
        }
    })
}

$(document).on('click', '#store', function (e) {
    // console.log('amediketu');
    $.ajax({
        url: 'http://cyberolympus.test/api/customers',
        method: 'POST',
        dataType: 'json',
        data: {
            nama: $('#nama').val(),
            alamat: $('#alamat').val(),
            nomor_telepon: $('#nomor_telepon').val()
        },
        success: res => {
            console.log(res);
            Swal.fire({
                icon: 'success',
                title: res.message,
            }).then((res) => {
                // $('#modal').modal('hide');
                location.reload()
            })
        },
        error: err => {
            console.log(err);
        }
    })
})