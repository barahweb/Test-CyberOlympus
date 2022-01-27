@extends('layouts.main')
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Halaman Data Customer</h1>
</div>
<div class="table-responsive col-lg-8">

    <form>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="roundText">Tanggal Awal</label>
                    <input type="date" class="form-control round" id="tanggalawal" name="tanggalawal"
                        value="{{ date('Y-m-d') }}">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="roundText">Tanggal Akhir</label>
                    <input type="date" class="form-control round" id="tanggalakhir" name="tanggalakhir"
                        value="{{ date('Y-m-d') }}">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input type="submit" name="submit" id="cari" class="btn btn-primary mt-4" value="Cari">
                </div>
            </div>
        </div>
    </form>
    <input type="text" class="form-control mt-3" placeholder="Search Customers" id="search">
    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal"
        id="tambah">
        Tambah Data Customer
    </button>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Nomor Telepon</th>
                <th scope="col">Tanggal Registrasi</th>
                <th scope="col">Aksi</th>

            </tr>
        </thead>
        <tbody id="tblcustomers">

        </tbody>
    </table>

    <div id="pagination">

    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formstore">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nama:</label>
                        <input type="text" class="form-control" id="nama">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Alamat:</label>
                        <input type="text" id="alamat" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Nomor Telepon:</label>
                        <input type="text" id="nomor_telepon" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Customer</h5>
            </div>
            <form id="updatecustomer" enctype="multipart/form-data">
                <div class="modal-body">
                    <form id="formstore">
                        <input type="hidden" id="idcustomer">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" id="nama2">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Alamat:</label>
                            <input type="text" id="alamat2" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Nomor Telepon:</label>
                            <input type="text" id="nomor_telepon2" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary updateCustomer">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection