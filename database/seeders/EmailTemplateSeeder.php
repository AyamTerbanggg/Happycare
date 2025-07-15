<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmailTemplate;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'name' => 'Welcome Email',
                'subject' => 'Selamat Datang di {{company_name}}',
                'content' => '
                <h2>Selamat Datang!</h2>
                <p>Halo {{name}},</p>
                <p>Terima kasih telah bergabung dengan {{company_name}}. Kami senang Anda telah memilih layanan kami.</p>
                <p>Berikut adalah informasi penting untuk Anda:</p>
                <ul>
                    <li>Username: {{username}}</li>
                    <li>Email: {{email}}</li>
                </ul>
                <p>Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi tim support kami.</p>
                <p>Salam,<br>Tim {{company_name}}</p>',
                'variables' => ['name', 'company_name', 'username', 'email'],
                'is_active' => true,
            ],
            [
                'name' => 'Password Reset',
                'subject' => 'Reset Password - {{company_name}}',
                'content' => '
                <h2>Reset Password</h2>
                <p>Halo {{name}},</p>
                <p>Kami menerima permintaan reset password untuk akun Anda.</p>
                <p>Klik link di bawah untuk reset password Anda:</p>
                <p><a href="{{reset_link}}" class="btn">Reset Password</a></p>
                <p>Link ini akan kadaluarsa dalam 60 menit.</p>
                <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
                <p>Salam,<br>Tim {{company_name}}</p>',
                'variables' => ['name', 'company_name', 'reset_link'],
                'is_active' => true,
            ],
            [
                'name' => 'Notification Email',
                'subject' => 'Notifikasi: {{title}}',
                'content' => '
                <h2>{{title}}</h2>
                <p>Halo {{name}},</p>
                <p>{{message}}</p>
                <p>Detail:</p>
                <ul>
                    <li>Tanggal: {{date}}</li>
                    <li>Waktu: {{time}}</li>
                </ul>
                <p>Terima kasih,<br>{{company_name}}</p>',
                'variables' => ['name', 'title', 'message', 'date', 'time', 'company_name'],
                'is_active' => true,
            ],
        ];

        foreach ($templates as $template) {
            EmailTemplate::create($template);
        }
    }
}
