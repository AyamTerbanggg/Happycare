@extends('layouts.admin')

@section('title', 'Template Email')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Template Email</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.email.create-template') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Buat Template
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Template</th>
                                    <th>Subjek</th>
                                    <th>Status</th>
                                    <th>Digunakan</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($templates as $template)
                                <tr>
                                    <td>{{ $template->name }}</td>
                                    <td>{{ Str::limit($template->subject, 50) }}</td>
                                    <td>
                                        @if($template->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>{{ $template->emailLogs()->count() }} kali</td>
                                    <td>{{ $template->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.email.edit-template', $template->id) }}" 
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning" 
                                           onclick="previewTemplate({{ $template->id }})">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.email.delete-template', $template->id) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus template ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada template email</td>
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

<!-- Preview Template Modal -->
<div class="modal fade" id="previewTemplateModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Template</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="templatePreviewContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewTemplate(templateId) {
    $.get(`/admin/email/templates/${templateId}/preview`, function(data) {
        $('#templatePreviewContent').html(`
            <div class="mb-3">
                <strong>Subjek:</strong> ${data.subject}
            </div>
            <div class="border p-3 bg-light">
                ${data.content}
            </div>
        `);
        $('#previewTemplateModal').modal('show');
    });
}
</script>
@endpush 