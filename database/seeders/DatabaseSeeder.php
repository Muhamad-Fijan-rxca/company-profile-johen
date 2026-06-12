<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\Berita;
use App\Models\Lowongan;
use App\Models\KontenDigital;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@johengaming.com'],
            [
                'name' => 'Admin Johen',
                'email' => 'admin@johengaming.com',
                'password' => Hash::make('Johen2025!'),
                'email_verified_at' => now(),
            ]
        );

        $produk = [
            ['nama' => 'Top Up Mobile Legends', 'kategori' => 'Top Up', 'deskripsi' => 'Top up Diamond Mobile Legends dengan harga terjangkau dan proses instan. Tersedia semua nominal dari 11 hingga 9999 Diamond.', 'harga' => 'Mulai Rp 2.000', 'unggulan' => true, 'urutan' => 1],
            ['nama' => 'Jual Beli Akun MLBB', 'kategori' => 'Jual Beli Akun', 'deskripsi' => 'Beli atau jual akun Mobile Legends dengan hero dan skin lengkap. Proses aman, cepat, dan terpercaya.', 'harga' => 'Mulai Rp 50.000', 'unggulan' => true, 'urutan' => 2],
            ['nama' => 'Jual Beli Akun PUBG Mobile', 'kategori' => 'Jual Beli Akun', 'deskripsi' => 'Akun PUBG Mobile dengan rank tinggi dan skin langka. Garansi keamanan transaksi.', 'harga' => 'Mulai Rp 100.000', 'unggulan' => true, 'urutan' => 3],
            ['nama' => 'Jual Beli Akun Free Fire', 'kategori' => 'Jual Beli Akun', 'deskripsi' => 'Akun Free Fire dengan skin karakter, senjata, dan pet langka. Harga bersaing dan proses cepat.', 'harga' => 'Mulai Rp 30.000', 'unggulan' => true, 'urutan' => 4],
            ['nama' => 'Top Up Free Fire', 'kategori' => 'Top Up', 'deskripsi' => 'Top up Diamond Free Fire murah dan cepat. Semua nominal tersedia, proses otomatis 24 jam.', 'harga' => 'Mulai Rp 1.500', 'unggulan' => false, 'urutan' => 5],
            ['nama' => 'Jual Beli Akun Roblox', 'kategori' => 'Jual Beli Akun', 'deskripsi' => 'Akun Roblox dengan item dan limited langka. Proses aman dan terpercaya.', 'harga' => 'Mulai Rp 25.000', 'unggulan' => false, 'urutan' => 6],
            ['nama' => 'Jual Beli Akun eFootball', 'kategori' => 'Jual Beli Akun', 'deskripsi' => 'Akun eFootball dengan pemain dan pelatih top. Tim lengkap siap pakai.', 'harga' => 'Mulai Rp 50.000', 'unggulan' => false, 'urutan' => 7],
            ['nama' => 'Jasa Joki Game Profesional', 'kategori' => 'Jasa Joki', 'deskripsi' => 'Layanan joki untuk push rank, event, dan misi game. Dikerjakan oleh player profesional dan terpercaya.', 'harga' => 'Mulai Rp 75.000', 'unggulan' => true, 'urutan' => 8],
            ['nama' => 'Live Commerce Gaming', 'kategori' => 'Live Commerce', 'deskripsi' => 'Live streaming penjualan akun dan top up game langsung melalui sosial media. Proses transparan dan interaktif.', 'harga' => 'Hubungi Kami', 'unggulan' => false, 'urutan' => 9],
        ];

        foreach ($produk as $p) {
            Produk::create(array_merge($p, ['aktif' => true]));
        }

        $berita = [
            [
                'judul' => 'PT. Johen Sukses Abadi Resmi Berdiri: Solusi Digital Gaming Commerce Terpercaya',
                'isi' => '<p>PT. Johen Sukses Abadi dengan bangga mengumumkan kehadiran resmi kami sebagai perusahaan digital gaming commerce yang terpercaya di Indonesia. Berdiri sejak tahun 2022, kami hadir sebagai solusi terpercaya dalam menyediakan berbagai layanan kebutuhan pemain game dan komunitas digital.</p><p>Fokus bisnis kami meliputi jual beli akun game online, top up game, jasa joki game, live commerce gaming, serta pengelolaan konten digital. Dengan tim yang berpengalaman dan sistem keamanan berlapis, kami berkomitmen memberikan pengalaman transaksi gaming yang aman, cepat, dan terpercaya.</p><p>Kami memiliki kantor operasional di Ruko Topaz No 60, Summarecon Bandung, siap melayani seluruh gamer Indonesia.</p>',
                'quote' => 'Peresmian ini menjadi tonggak awal perjalanan kami dalam membangun platform digital gaming yang aman, nyaman, dan terpercaya bagi seluruh gamer di Indonesia.',
                'thumbnail' => 'img/bg/bg1.jpeg',
            ],
            [
                'judul' => 'Tips Aman Jual Beli Akun Game dari Johen Gaming',
                'isi' => '<p>Jual beli akun game semakin populer di Indonesia. Namun, banyak kasus penipuan yang merugikan para gamer. Berikut tips aman dari tim Johen Gaming:</p><p><strong>1. Gunakan platform terpercaya</strong> - Selalu bertransaksi melalui perusahaan resmi yang memiliki kantor operasional dan sistem keamanan terjamin seperti PT. Johen Sukses Abadi.</p><p><strong>2. Verifikasi akun sebelum membeli</strong> - Pastikan akun yang dibeli sesuai deskripsi dengan meminta screenshot atau video bukti.</p><p><strong>3. Hindari transfer langsung</strong> - Gunakan sistem pembayaran yang aman dan hindari transfer langsung ke rekening pribadi penjual.</p><p><strong>4. Cek reputasi penjual</strong> - Pastikan penjual memiliki track record dan testimoni yang baik dari pembeli sebelumnya.</p>',
                'quote' => 'Keamanan adalah prioritas utama kami dalam setiap transaksi jual beli akun game.',
                'thumbnail' => 'img/bg/bg2.jpeg',
            ],
            [
                'judul' => 'Johen Gaming Kini Hadir dengan Live Commerce untuk Pengalaman Belanja Lebih Interaktif',
                'isi' => '<p>PT. Johen Sukses Abadi (Johen Gaming) terus berinovasi dengan meluncurkan layanan live commerce gaming. Melalui live streaming di media sosial, pelanggan dapat melihat langsung akun yang dijual, bertanya secara real-time, dan bertransaksi dengan lebih transparan.</p><p>Layanan live commerce ini mencakup penjualan akun game, top up, dan sesi joki game yang disiarkan langsung oleh host dan kreator konten profesional kami.</p><p>Ikuti akun media sosial Johen Gaming untuk jadwal live streaming terbaru: @johengaming.mlbb, @johengaming.pubg, dan @johengaming.offline.</p>',
                'quote' => 'Belanja sambil live streaming — pengalaman baru yang lebih interaktif dan transparan.',
                'thumbnail' => 'img/bg/bg1.jpeg',
            ],
            [
                'judul' => 'Lowongan Kerja: Johen Gaming Kembangkan Tim Profesional',
                'isi' => '<p>PT. Johen Sukses Abadi (Johen Gaming) sedang membuka lowongan kerja untuk berbagai posisi dalam rangka mengembangkan tim profesional kami. Dengan struktur organisasi yang terdiri dari CEO, General Manager, HR, IT, Resepsionis, Head of Store, Admin, Host/Joki, dan Content Creator, kami mencari talenta terbaik yang ingin bergabung dalam industri gaming commerce.</p><p>Kami memiliki divisi store yang terdiri dari Johen MLBB, Johen Roblox, Johen PUBG, dan Monkey PUBG. Budaya kerja kami profesional, disiplin, bertanggung jawab, dan saling menghargai.</p><p>Bagi Anda yang berminat, pantau halaman karir website kami untuk informasi lowongan terbaru.</p>',
                'quote' => 'Kami mencari talenta terbaik untuk bergabung dan berkembang bersama Johen Gaming.',
                'thumbnail' => 'img/bg/bg2.jpeg',
            ],
        ];

        foreach ($berita as $b) {
            Berita::create(array_merge($b, [
                'slug' => Str::slug($b['judul']),
                'aktif' => true,
            ]));
        }

        $lowongan = [
            [
                'posisi' => 'Admin Store',
                'departemen' => 'Operasional',
                'deskripsi' => 'Mengelola operasional store Johen Gaming, melayani transaksi jual beli akun dan top up game, serta memastikan kepuasan pelanggan.',
                'persyaratan' => "- Pendidikan minimal SMA/SMK sederajat\n- Komunikatif dan ramah\n- Familiar dengan game online (MLBB, PUBG, Free Fire, Roblox, eFootball)\n- Bisa bekerja shift\n- Pengalaman di bidang gaming (diutamakan)",
                'tipe' => 'Full-time',
            ],
            [
                'posisi' => 'Host / Joki Game',
                'departemen' => 'Store',
                'deskripsi' => 'Melakukan live streaming penjualan dan jasa joki game untuk berbagai platform game online. Menjadi wajah Johen Gaming di media sosial.',
                'persyaratan' => "- Pendidikan minimal SMA/SMK sederajat\n- Rank tinggi di game terkait (MLBB, PUBG, Free Fire, dll)\n- Aktif di media sosial\n- Komunikatif dan percaya diri di depan kamera\n- Pengalaman live streaming (diutamakan)",
                'tipe' => 'Full-time',
            ],
            [
                'posisi' => 'Content Creator Gaming',
                'departemen' => 'Konten Digital',
                'deskripsi' => 'Memproduksi konten digital gaming untuk media sosial Johen Gaming, termasuk video, desain grafis, dan copywriting promosi.',
                'persyaratan' => "- Pendidikan minimal D3/S1 Desain, Komunikasi, atau sejenisnya\n- Menguasai software editing video dan desain grafis\n- Memahami tren konten gaming di media sosial\n- Kreatif dan up-to-date dengan industri gaming\n- Portofolio konten (wajib)",
                'tipe' => 'Full-time',
            ],
            [
                'posisi' => 'Resepsionis / Customer Service',
                'departemen' => 'Operasional',
                'deskripsi' => 'Menyambut dan melayani pelanggan yang datang ke kantor, menangani pertanyaan via telepon dan chat, serta mendukung administrasi kantor.',
                'persyaratan' => "- Pendidikan minimal D3 semua jurusan\n- Komunikatif dan ramah\n- Menguasai Microsoft Office\n- Familiar dengan media sosial\n- Pengalaman CS atau resepsionis (diutamakan)",
                'tipe' => 'Full-time',
            ],
        ];

        foreach ($lowongan as $l) {
            Lowongan::create($l);
        }

        // Konten Digital
        $kontenDigital = [
            [
                'judul' => 'Live Streaming Jual Beli Akun',
                'kategori' => 'Live Commerce',
                'deskripsi' => 'Layanan live streaming interaktif untuk jual beli akun game secara langsung di media sosial. Pelanggan dapat melihat detail akun secara real-time, bertanya langsung kepada host, dan bertransaksi dengan lebih transparan dan terpercaya.',
                'unggulan' => true, 'urutan' => 1,
            ],
            [
                'judul' => 'Live Top Up Game',
                'kategori' => 'Live Commerce',
                'deskripsi' => 'Sesi live streaming khusus untuk layanan top up game dengan harga spesial. Dapatkan promo eksklusif dan bonus menarik yang hanya tersedia selama sesi live berlangsung.',
                'unggulan' => true, 'urutan' => 2,
            ],
            [
                'judul' => 'Live Joki & Coaching',
                'kategori' => 'Live Commerce',
                'deskripsi' => 'Sesi live streaming jasa joki dan coaching game oleh player profesional. Saksikan langsung proses push rank dan pelajari strategi terbaik dari para ahli gaming kami.',
                'unggulan' => false, 'urutan' => 3,
            ],
            [
                'judul' => 'Pembuatan Konten Gaming',
                'kategori' => 'Konten Digital',
                'deskripsi' => 'Layanan produksi konten digital gaming profesional untuk kebutuhan media sosial, promosi, dan branding. Meliputi video gameplay, highlight, dan konten edukatif seputar dunia gaming.',
                'unggulan' => true, 'urutan' => 4,
            ],
            [
                'judul' => 'Desain Grafis Gaming',
                'kategori' => 'Konten Digital',
                'deskripsi' => 'Layanan desain grafis bertema gaming untuk kebutuhan thumbnail, banner, poster promosi, dan aset visual media sosial. Desain modern, menarik, dan sesuai identitas brand Anda.',
                'unggulan' => false, 'urutan' => 5,
            ],
            [
                'judul' => 'Manajemen Media Sosial Gaming',
                'kategori' => 'Konten Digital',
                'deskripsi' => 'Layanan pengelolaan akun media sosial bertema gaming secara profesional. Meliputi pembuatan konten, penjadwalan posting, engagement, dan pelaporan performa akun secara berkala.',
                'unggulan' => false, 'urutan' => 6,
            ],
        ];

        foreach ($kontenDigital as $k) {
            KontenDigital::create(array_merge($k, ['aktif' => true]));
        }
    }
}
