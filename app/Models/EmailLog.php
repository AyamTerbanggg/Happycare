<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'to',
        'subject',
        'message',
        'template_id',
        'status',
        'sent_at',
        'error_message',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    /**
     * Relasi dengan EmailTemplate
     */
    public function template()
    {
        return $this->belongsTo(EmailTemplate::class);
    }

    /**
     * Scope untuk email yang berhasil dikirim
     */
    public function scopeSent($query)
    {
        return $query->where('status', 'sent');
    }

    /**
     * Scope untuk email yang gagal dikirim
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope untuk email hari ini
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    /**
     * Get status badge
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'sent' => '<span class="badge bg-success">Terkirim</span>',
            'failed' => '<span class="badge bg-danger">Gagal</span>',
            'pending' => '<span class="badge bg-warning">Menunggu</span>',
            'processing' => '<span class="badge bg-info">Diproses</span>',
            default => '<span class="badge bg-secondary">Unknown</span>',
        };
    }
} 