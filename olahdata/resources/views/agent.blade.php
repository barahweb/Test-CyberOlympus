@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="margin-top:100px">
            <h2>Agent paling banyak mendapatkan customer</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Agent</th>
                        <th scope="col">Jumlah mendapatkan customer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $d->agent_name }}</td>
                        <td>{{ $d->jumlahcust }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </main>
    </div>
</div>
@endsection