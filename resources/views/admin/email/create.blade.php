@extends('layouts.admin')

@section('title', 'Kirim Email')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kirim Email</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.email.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.email.send') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Form Email -->
                                <div class="form-group">
                                    <label for="to">Kepada <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('to') is-invalid @enderror" 
                                           id="to" name="to" value="{{ old('to') }}" required>
                                    @error('to')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="subject">Subjek <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                           id="subject" name="subject" value="{{ old('subject') }}" required>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="template_id">Template Email (Opsional)</label>
                                    <select class="form-control @error('template_id') is-invalid @enderror" 
                                            id="template_id" name="template_id">
                                        <option value="">Pilih Template</option>
                                        @foreach($templates as $template)
                                            <option value="{{ $template->id }}" 
                                                    {{ old('template_id') == $template->id ? 'selected' : '' }}>
                                                {{ $template->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('template_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="message">Pesan <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" 
                                              id="message" name="message" rows="10" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane"></i> Kirim Email
                                    </button>
                                    <a href="{{ route('admin.email.index') }}" class="btn btn-secondary">
                                        Batal
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Preview Template -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Preview Template</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="templatePreview">
                                            <p class="text-muted">Pilih template untuk melihat preview</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tips -->
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h5 class="card-title">Tips</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-info-circle text-info"></i> Gunakan template untuk email yang konsisten</li>
                                            <li><i class="fas fa-info-circle text-info"></i> Pastikan alamat email valid</li>
                                            <li><i class="fas fa-info-circle text-info"></i> Gunakan variabel {{name}} untuk personalisasi</li>
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
    $('#template_id').change(function() {
        const templateId = $(this).val();
        if (templateId) {
            $.get(`/admin/email/templates/${templateId}/preview`, function(data) {
                $('#templatePreview').html(`
                    <h6>${data.subject}</h6>
                    <div class="border p-2 bg-light">
                        ${data.content}
                    </div>
                `);
            });
        } else {
            $('#templatePreview').html('<p class="text-muted">Pilih template untuk melihat preview</p>');
        }
    });

    // Auto-fill subject when template is selected
    $('#template_id').change(function() {
        const templateId = $(this).val();
        if (templateId) {
            $.get(`/admin/email/templates/${templateId}/preview`, function(data) {
                $('#subject').val(data.subject);
            });
        }
    });
});
</script>
@endpush 