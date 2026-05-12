<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\Berita;
use App\Models\Lowongan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@johengaming.com'],
            [
                'name' => 'Admin Johen',
                'email' => 'admin@johengaming.com',
                'password' => Hash::make('Johen2025!'),
                'email_verified_at' => now(),
            ]
        );

        // Produk
        $produk = [
            ['nama' => 'Top Up Mobile Legends', 'kategori' => 'Top Up', 'deskripsi' => 'Top up Diamond Mobile Legends dengan harga terjangkau dan proses instan. Tersedia semua nominal dari 11 hingga 9999 Diamond.', 'harga' => 'Mulai Rp 2.000', 'unggulan' => true, 'urutan' => 1],
            ['nama' => 'Jual Beli Akun MLBB', 'kategori' => 'Jual Beli Akun', 'deskripsi' => 'Beli atau jual akun Mobile Legends dengan hero dan skin lengkap. Proses aman, cepat, dan terpercaya.', 'harga' => 'Mulai Rp 50.000', 'unggulan' => true, 'urutan' => 2],
            ['nama' => 'Top Up Free Fire', 'kategori' => 'Top Up', 'deskripsi' => 'Top up Diamond Free Fire murah dan cepat. Semua nominal tersedia, proses otomatis 24 jam.', 'harga' => 'Mulai Rp 1.500', 'unggulan' => true, 'urutan' => 3],
            ['nama' => 'Jual Beli Akun PUBG Mobile', 'kategori' => 'Jual Beli Akun', 'deskripsi' => 'Akun PUBG Mobile dengan rank tinggi dan skin langka. Garansi keamanan transaksi.', 'harga' => 'Mulai Rp 100.000', 'unggulan' => false, 'urutan' => 4],
            ['nama' => 'Top Up Genshin Impact', 'kategori' => 'Top Up', 'deskripsi' => 'Top up Genesis Crystal Genshin Impact dengan harga kompetitif. Proses cepat dan aman.', 'harga' => 'Mulai Rp 15.000', 'unggulan' => false, 'urutan' => 5],
            ['nama' => 'Boost Rank Game', 'kategori' => 'Jasa', 'deskripsi' => 'Layanan boost rank untuk berbagai game populer. Dikerjakan oleh player profesional berpengalaman.', 'harga' => 'Mulai Rp 75.000', 'unggulan' => false, 'urutan' => 6],
        ];

        foreach ($produk as $p) {
            Produk::create(array_merge($p, ['aktif' => true]));
        }

        // Berita
        $berita = [
            [
                'judul' => 'Johen Gaming Resmi Hadir: Solusi Lengkap Kebutuhan Game Anda',
                'isi' => '<p>PT Johen Gaming dengan bangga mengumumkan kehadiran resmi kami sebagai platform terpercaya untuk semua kebutuhan gaming Anda. Kami hadir dengan layanan top up game, jual beli akun, dan berbagai layanan gaming lainnya.</p><p>Dengan tim yang berpengalaman dan sistem keamanan berlapis, kami berkomitmen memberikan pengalaman transaksi gaming yang aman, cepat, dan terpercaya untuk seluruh gamer Indonesia.</p><p>Kunjungi platform kami dan rasakan kemudahan bertransaksi game dengan harga terbaik di pasaran.</p>',
            ],
            [
                'judul' => 'Tips Aman Jual Beli Akun Game: Panduan dari Johen Gaming',
                'isi' => '<p>Jual beli akun game semakin populer di Indonesia. Namun, banyak kasus penipuan yang merugikan para gamer. Berikut tips aman dari tim Johen Gaming:</p><p><strong>1. Gunakan platform terpercaya</strong> - Selalu bertransaksi melalui platform resmi yang memiliki sistem escrow dan garansi.</p><p><strong>2. Verifikasi akun sebelum membeli</strong> - Pastikan akun yang dibeli sesuai deskripsi dengan meminta screenshot atau video bukti.</p><p><strong>3. Jangan transfer langsung</strong> - Gunakan sistem pembayaran yang aman dan hindari transfer langsung ke rekening pribadi penjual.</p>',
            ],
            [
                'judul' => 'Update Harga Top Up Diamond Mobile Legends Terbaru 2025',
                'isi' => '<p>Johen Gaming kembali menghadirkan harga terbaik untuk top up Diamond Mobile Legends. Mulai bulan ini, kami menurunkan harga untuk semua nominal Diamond ML.</p><p>Dapatkan bonus Diamond ekstra untuk setiap pembelian di atas 500 Diamond. Promo berlaku hingga akhir bulan dan hanya untuk member terdaftar.</p><p>Segera daftarkan diri Anda dan nikmati harga spesial dari Johen Gaming!</p>',
            ],
            [
                'judul' => 'Johen Gaming Perluas Layanan ke Genshin Impact dan Honkai Star Rail',
                'isi' => '<p>Merespons tingginya permintaan dari komunitas gamer, PT Johen Gaming kini resmi melayani top up untuk Genshin Impact dan Honkai Star Rail.</p><p>Layanan ini hadir dengan harga kompetitif dan proses yang sama cepatnya dengan layanan game lain yang sudah ada. Tim kami siap melayani 24 jam sehari, 7 hari seminggu.</p>',
            ],
        ];

        foreach ($berita as $b) {
            Berita::create(array_merge($b, [
                'slug' => Str::slug($b['judul']),
                'aktif' => true,
            ]));
        }

        // Lowongan
        $lowongan = [
            [
                'posisi' => 'Customer Service',
                'departemen' => 'Operasional',
                'deskripsi' => 'Melayani pelanggan melalui chat dan telepon, membantu proses transaksi, dan menangani keluhan pelanggan dengan profesional.',
                'persyaratan' => "- Pendidikan minimal SMA/SMK sederajat\n- Komunikatif dan ramah\n- Familiar dengan game online populer\n- Bisa bekerja shift\n- Pengalaman CS minimal 1 tahun (diutamakan)",
                'tipe' => 'Full-time',
            ],
            [
                'posisi' => 'Digital Marketing Specialist',
                'departemen' => 'Marketing',
                'deskripsi' => 'Mengelola konten media sosial, kampanye iklan digital, dan strategi pemasaran online untuk meningkatkan brand awareness PT Johen Gaming.',
                'persyaratan' => "- Pendidikan minimal D3/S1 Marketing atau Komunikasi\n- Menguasai Meta Ads dan Google Ads\n- Pengalaman minimal 2 tahun di bidang digital marketing\n- Kreatif dan up-to-date dengan tren gaming\n- Portofolio kampanye digital diutamakan",
                'tipe' => 'Full-time',
            ],
            [
                'posisi' => 'Web Developer',
                'departemen' => 'IT',
                'deskripsi' => 'Mengembangkan dan memelihara platform website PT Johen Gaming, memastikan performa optimal dan pengalaman pengguna terbaik.',
                'persyaratan' => "- Pendidikan minimal S1 Teknik Informatika atau sejenisnya\n- Menguasai PHP/Laravel dan JavaScript\n- Familiar dengan MySQL dan Redis\n- Pengalaman minimal 2 tahun\n- Memahami konsep keamanan web",
                'tipe' => 'Full-time',
            ],
        ];

        foreach ($lowongan as $l) {
            Lowongan::create($l);
        }
    }
}
