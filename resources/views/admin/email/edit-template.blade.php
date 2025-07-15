@extends('layouts.admin')

@section('title', 'Edit Template Email')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Template Email</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.email.templates') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.email.update-template', $template->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name">Nama Template <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $template->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="subject">Subjek Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                           id="subject" name="subject" value="{{ old('subject', $template->subject) }}" required>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="content">Konten Template <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="content" name="content" rows="15" required>{{ old('content', $template->content) }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="variables">Variabel yang Tersedia (Opsional)</label>
                                    <input type="text" class="form-control @error('variables') is-invalid @enderror" 
                                           id="variables" name="variables" value="{{ old('variables', is_array($template->variables) ? implode(',', $template->variables) : $template->variables) }}" 
                                           placeholder="Contoh: name,email,company_name">
                                    <small class="form-text text-muted">
                                        Pisahkan variabel dengan koma. Contoh: name,email,company_name
                                    </small>
                                    @error('variables')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" 
                                               {{ $template->is_active ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active">Template Aktif</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update Template
                                    </button>
                                    <a href="{{ route('admin.email.templates') }}" class="btn btn-secondary">
                                        Batal
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Preview -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Preview Template</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="templatePreview">
                                            <h6>{{ $template->subject }}</h6>
                                            <div class="border p-2 bg-light">
                                                {!! $template->content !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Variabel yang Tersedia -->
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h5 class="card-title">Variabel yang Tersedia</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled">
                                            <li><code>{{name}}</code> - Nama penerima</li>
                                            <li><code>{{email}}</code> - Email penerima</li>
                                            <li><code>{{company_name}}</code> - Nama perusahaan</li>
                                            <li><code>{{username}}</code> - Username</li>
                                            <li><code>{{reset_link}}</code> - Link reset password</li>
                                            <li><code>{{title}}</code> - Judul notifikasi</li>
                                            <li><code>{{message}}</code> - Pesan</li>
                                            <li><code>{{date}}</code> - Tanggal</li>
                                            <li><code>{{time}}</code> - Waktu</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Preview template
    function updatePreview() {
        const name = $('#name').val();
        const subject = $('#subject').val();
        const content = $('#content').val();
        
        if (name && subject && content) {
            $('#templatePreview').html(`
                <h6>${subject}</h6>
                <div class="border p-2 bg-light">
                    ${content}
                </div>
            `);
        } else {
            $('#templatePreview').html('<p class="text-muted">Isi form untuk melihat preview</p>');
        }
    }

    $('#name, #subject, #content').on('input', updatePreview);
});
</script>
@endpush 