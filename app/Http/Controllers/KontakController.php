<?php

namespace App\Http\Controllers;

use App\Models\PesanKontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak');
    }

    public function kirim(Request $request)
    {
        $validated = $request->validate([
            'tujuan'    => 'required|in:cs',
            'nama'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'no_hp'     => 'required|string|max:20',
            'nama_game' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $pesan = PesanKontak::create($validated);

        try {
            Mail::send('emails.notif_kontak', ['pesan' => $pesan], function ($m) use ($pesan) {
                $m->to(config('mail.from.address'))
                  ->subject('[JOHEN GAMING] Pesan CS Baru - ' . $pesan->nama);
            });
        } catch (\Exception $e) {}

        return back()->with('success', 'Pesan Anda berhasil dikirim! Tim CS kami akan segera menghubungi Anda.');
    }
}
