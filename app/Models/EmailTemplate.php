<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject',
        'content',
        'variables',
        'is_active',
    ];

    protected $casts = [
        'variables' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi dengan EmailLog
     */
    public function emailLogs()
    {
        return $this->hasMany(EmailLog::class);
    }

    /**
     * Scope untuk template aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Parse variabel dalam template
     */
    public function parseVariables($data = [])
    {
        $content = $this->content;
        $subject = $this->subject;

        foreach ($data as $key => $value) {
            $content = str_replace('{{' . $key . '}}', $value, $content);
            $subject = str_replace('{{' . $key . '}}', $value, $subject);
        }

        return [
            'subject' => $subject,
            'content' => $content,
        ];
    }
} 