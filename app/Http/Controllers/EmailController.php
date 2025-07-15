<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\EmailTemplate;
use App\Models\EmailLog;
use App\Mail\CustomEmail;
use App\Jobs\SendEmailJob;

class EmailController extends Controller
{
    /**
     * Menampilkan halaman dashboard email
     */
    public function index()
    {
        $emailStats = [
            'total_sent' => EmailLog::count(),
            'sent_today' => EmailLog::whereDate('created_at', today())->count(),
            'templates' => EmailTemplate::count(),
        ];

        $recentEmails = EmailLog::with('template')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.email.index', compact('emailStats', 'recentEmails'));
    }

    /**
     * Menampilkan form untuk mengirim email
     */
    public function create()
    {
        $templates = EmailTemplate::all();
        return view('admin.email.create', compact('templates'));
    }

    /**
     * Mengirim email
     */
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'template_id' => 'nullable|exists:email_templates,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Simpan log email dengan status pending
            $emailLog = EmailLog::create([
                'to' => $request->to,
                'subject' => $request->subject,
                'message' => $request->message,
                'template_id' => $request->template_id,
                'status' => 'pending',
            ]);

            // Dispatch job untuk mengirim email di background
            SendEmailJob::dispatch($emailLog);

            return redirect()->route('admin.email.index')
                ->with('success', 'Email berhasil dijadwalkan untuk dikirim!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menjadwalkan email: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Menampilkan riwayat email
     */
    public function logs()
    {
        $logs = EmailLog::with('template')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.email.logs', compact('logs'));
    }

    /**
     * Menampilkan detail email log
     */
    public function show($id)
    {
        $log = EmailLog::with('template')->findOrFail($id);
        return view('admin.email.show', compact('log'));
    }

    /**
     * Menampilkan template email
     */
    public function templates()
    {
        $templates = EmailTemplate::orderBy('created_at', 'desc')->get();
        return view('admin.email.templates', compact('templates'));
    }

    /**
     * Menampilkan form untuk membuat template
     */
    public function createTemplate()
    {
        return view('admin.email.create-template');
    }

    /**
     * Menyimpan template email
     */
    public function storeTemplate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'variables' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        
        // Handle variables
        if ($request->variables) {
            $variables = array_map('trim', explode(',', $request->variables));
            $data['variables'] = $variables;
        }
        
        // Handle is_active checkbox
        $data['is_active'] = $request->has('is_active');

        EmailTemplate::create($data);

        return redirect()->route('admin.email.templates')
            ->with('success', 'Template email berhasil dibuat!');
    }

    /**
     * Menampilkan form untuk edit template
     */
    public function editTemplate($id)
    {
        $template = EmailTemplate::findOrFail($id);
        return view('admin.email.edit-template', compact('template'));
    }

    /**
     * Update template email
     */
    public function updateTemplate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'variables' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $template = EmailTemplate::findOrFail($id);
        
        $data = $request->all();
        
        // Handle variables
        if ($request->variables) {
            $variables = array_map('trim', explode(',', $request->variables));
            $data['variables'] = $variables;
        }
        
        // Handle is_active checkbox
        $data['is_active'] = $request->has('is_active');

        $template->update($data);

        return redirect()->route('admin.email.templates')
            ->with('success', 'Template email berhasil diperbarui!');
    }

    /**
     * Hapus template email
     */
    public function deleteTemplate($id)
    {
        $template = EmailTemplate::findOrFail($id);
        $template->delete();

        return redirect()->route('admin.email.templates')
            ->with('success', 'Template email berhasil dihapus!');
    }

    /**
     * Preview template email
     */
    public function previewTemplate($id)
    {
        $template = EmailTemplate::findOrFail($id);
        
        return response()->json([
            'subject' => $template->subject,
            'content' => $template->content,
        ]);
    }

    /**
     * Test koneksi email
     */
    public function testConnection()
    {
        try {
            Mail::raw('Test email dari sistem', function ($message) {
                $message->to(config('mail.from.address'))
                    ->subject('Test Koneksi Email');
            });

            return response()->json([
                'success' => true,
                'message' => 'Koneksi email berhasil!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim test email: ' . $e->getMessage()
            ]);
        }
    }
} 