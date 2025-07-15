@extends('layouts.admin')

@section('title', 'Detail Email')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Email</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.email.logs') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150"><strong>Kepada:</strong></td>
                                    <td>{{ $log->to }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Subjek:</strong></td>
                                    <td>{{ $log->subject }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Template:</strong></td>
                                    <td>{{ $log->template ? $log->template->name : 'Tidak menggunakan template' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>{!! $log->status_badge !!}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Kirim:</strong></td>
                                    <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                @if($log->sent_at)
                                <tr>
                                    <td><strong>Waktu Terkirim:</strong></td>
                                    <td>{{ $log->sent_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                @endif
                                @if($log->error_message)
                                <tr>
                                    <td><strong>Error:</strong></td>
                                    <td class="text-danger">{{ $log->error_message }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Pesan Email</h5>
                                </div>
                                <div class="card-body">
                                    <div class="border p-3 bg-light">
                                        {!! nl2br(e($log->message)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 