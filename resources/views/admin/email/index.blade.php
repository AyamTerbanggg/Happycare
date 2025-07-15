@extends('layouts.admin')

@section('title', 'Email Server Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Email Server Dashboard</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.email.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Kirim Email
                        </a>
                        <a href="{{ route('admin.email.templates') }}" class="btn btn-info">
                            <i class="fas fa-file-alt"></i> Template
                        </a>
                        <a href="{{ route('admin.email.logs') }}" class="btn btn-warning">
                            <i class="fas fa-history"></i> Riwayat
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Statistik -->
                    <div class="row mb-4">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $emailStats['total_sent'] }}</h3>
                                    <p>Total Email Terkirim</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $emailStats['sent_today'] }}</h3>
                                    <p>Email Hari Ini</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $emailStats['templates'] }}</h3>
                                    <p>Template Email</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3 id="testResult">-</h3>
                                    <p>Status Koneksi</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-server"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Email Terbaru -->
                    <div class="row">
                        <div class="col-12">
                            <h5>Email Terbaru</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kepada</th>
                                            <th>Subjek</th>
                                            <th>Template</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentEmails as $email)
                                        <tr>
                                            <td>{{ $email->to }}</td>
                                            <td>{{ Str::limit($email->subject, 50) }}</td>
                                            <td>{{ $email->template ? $email->template->name : '-' }}</td>
                                            <td>{!! $email->status_badge !!}</td>
                                            <td>{{ $email->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.email.show', $email->id) }}" 
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada email terkirim</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Test Connection Modal -->
<div class="modal fade" id="testConnectionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Test Koneksi Email</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Klik tombol di bawah untuk menguji koneksi email server.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="testConnectionBtn">
                    <i class="fas fa-play"></i> Test Koneksi
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Test koneksi email
    $('#testConnectionBtn').click(function() {
        const btn = $(this);
        const originalText = btn.html();
        
        btn.html('<i class="fas fa-spinner fa-spin"></i> Testing...');
        btn.prop('disabled', true);
        
        $.ajax({
            url: '{{ route("admin.email.test-connection") }}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#testResult').html('<i class="fas fa-check text-success"></i> OK');
                    toastr.success(response.message);
                } else {
                    $('#testResult').html('<i class="fas fa-times text-danger"></i> Error');
                    toastr.error(response.message);
                }
            },
            error: function() {
                $('#testResult').html('<i class="fas fa-times text-danger"></i> Error');
                toastr.error('Terjadi kesalahan saat menguji koneksi');
            },
            complete: function() {
                btn.html(originalText);
                btn.prop('disabled', false);
                $('#testConnectionModal').modal('hide');
            }
        });
    });
});
</script>
@endpush 