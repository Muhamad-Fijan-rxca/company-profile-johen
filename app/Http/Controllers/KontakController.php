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
        $rules = [
            'tujuan' => 'required|in:jual,beli',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
        ];

        if ($request->tujuan === 'jual') {
            $rules += [
                'nama_game' => 'required|string|max:255',
                'level_akun' => 'required|string|max:255',
                'harga_harapan' => 'required|string|max:255',
                'deskripsi' => 'required|string',
            ];
        } else {
            $rules += [
                'game_dicari' => 'required|string|max:255',
                'budget_maksimal' => 'required|string|max:255',
                'request_khusus' => 'nullable|string',
            ];
        }

        $validated = $request->validate($rules);
        $pesan = PesanKontak::create($validated);

        // Kirim notifikasi email ke admin
        try {
            Mail::send('emails.notif_kontak', ['pesan' => $pesan], function ($m) use ($pesan) {
                $m->to(config('mail.from.address'))
                  ->subject('[Johen Gaming] Pesan Baru: ' . strtoupper($pesan->tujuan) . ' Akun - ' . $pesan->nama);
            });
        } catch (\Exception $e) {
            // Gagal kirim email tidak menghentikan proses
        }

        return back()->with('success', 'Pesan Anda berhasil dikirim! Tim kami akan segera menghubungi Anda.');
    }
}
