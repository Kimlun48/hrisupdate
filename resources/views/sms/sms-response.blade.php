@extends('layouts.app-master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Respons Mass SMS</div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nomor Tujuan</th>
                            <th>Status</th>
                            <th>Respons</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($responses as $response)
                            <tr>
                                <td>{{ $response['recipient'] }}</td>
                                <td>{{ $response['status'] }}</td>
                                <td>{{ json_encode($response['response']) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
