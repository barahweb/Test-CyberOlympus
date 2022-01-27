@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="margin-top:100px">
            <h2>Daftar Order</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama Customer</th>
                        <th scope="col">Payment Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->payment_date }}</td>
                        @if ($d->status == '1')
                        <td>Order Baru</td>
                        @elseif ($d->status == '2')
                        <td>Pembayaran berhasil</td>
                        @elseif ($d->status == '3')
                        <td>order process</td>
                        @elseif ($d->status == '4')
                        <td>order completed</td>
                        @elseif ($d->status == '5')
                        <td>order cancel</td>
                        @elseif ($d->status == '6')
                        <td>Pembayaran pending</td>
                        @elseif ($d->status == '7')
                        <td>Pembayaran gagal</td>
                        @endif
                        <td><a href="/daftarorder/detail/{{ $d->id }}" class="btn btn-info">Detail</span>
                            </a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </main>
    </div>
</div>
@endsection