@extends('layouts.app-master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Log Respons SMS</div>

            <div class="card-body">

                <form action="/logsms" method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">Tanggal Awal:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $startDate }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">Tanggal Akhir:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $endDate }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>

                @if ($logs->isEmpty())
                    <p>Tidak ada log respons yang tersedia.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nomor Tujuan</th>
                                <th>Pesan</th>
                                <th></th>
                                <th>Status</th>
                                <th>Error Massage</th>
                                <th>OTP Terverifikasi</th>
                                <th>Password Berhasil Diubah</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    <td>{{ $log->to }}</td>
                                    <td>{{ $log->message }}</td>
                                    @foreach ($responses as $response)
                                            <td>{{ $response['recipient'] }}</td>
                                            <td>{{ $response['status'] }}</td>
                                            <td>{{ json_encode($response['response']) }}</td>
                                    @endforeach
                                    <td>{{ $log->otp_verified ? 'Ya' : 'Tidak' }}</td>
                                    <td>{{ $log->password_changed ? 'Ya' : 'Tidak' }}</td>
                                    <td>{{ $log->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
