<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('is_admin', true)->first();
        
        if (!$admin) {
            return;
        }

        Blog::create([
            'user_id' => $admin->id,
            'title' => 'Tips Memilih Mobil Rental yang Tepat',
            'slug' => 'tips-memilih-mobil-rental',
            'excerpt' => 'Panduan lengkap untuk memilih mobil rental yang sesuai dengan kebutuhan Anda',
            'content' => '<h2>Memilih Mobil Rental yang Tepat</h2><p>Ketika Anda berencana untuk melakukan perjalanan, salah satu keputusan penting adalah memilih mobil rental yang tepat. Berikut adalah beberapa tips yang dapat membantu Anda:</p><h3>1. Tentukan Kebutuhan Anda</h3><p>Pertimbangkan jumlah penumpang, jumlah barang bawaan, dan jarak perjalanan yang akan Anda lakukan. Mobil yang berbeda memiliki kapasitas yang berbeda.</p><h3>2. Periksa Kondisi Kendaraan</h3><p>Sebelum menyetujui penyewaan, periksa kondisi eksternal dan internal mobil. Pastikan semua fitur berfungsi dengan baik.</p><h3>3. Bandingkan Harga</h3><p>Jangan hanya melihat harga per hari, tetapi juga pertimbangkan asuransi, biaya tambahan, dan tunjangan bahan bakar.</p>',
            'is_published' => true,
            'published_at' => now(),
        ]);

        Blog::create([
            'user_id' => $admin->id,
            'title' => 'Panduan Perjalanan Aman dengan Mobil Rental',
            'slug' => 'panduan-perjalanan-aman-mobil-rental',
            'excerpt' => 'Panduan keselamatan saat berkendara dengan mobil rental',
            'content' => '<h2>Perjalanan Aman dengan Mobil Rental</h2><p>Keselamatan adalah prioritas utama saat berkendara. Berikut adalah panduan untuk memastikan perjalanan Anda aman:</p><h3>Sebelum Berkendara</h3><ul><li>Periksa tekanan ban</li><li>Periksa level oli dan cairan pendingin</li><li>Pastikan lampu-lampu berfungsi</li><li>Periksa rem dan sistem kemudi</li></ul><h3>Saat Berkendara</h3><ul><li>Patuhi batas kecepatan</li><li>Gunakan sabuk pengaman</li><li>Hindari mengemudi saat mengantuk</li><li>Jangan gunakan ponsel saat berkendara</li></ul><h3>Parkir dan Keamanan</h3><p>Selalu parkir di tempat yang aman dan tidak meninggalkan barang berharga di dalam mobil.</p>',
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);

        Blog::create([
            'user_id' => $admin->id,
            'title' => 'Destinasi Wisata yang Cocok untuk Perjalanan Mobil',
            'slug' => 'destinasi-wisata-perjalanan-mobil',
            'excerpt' => 'Rekomendasi destinasi wisata yang sempurna untuk petualangan mobil rental Anda',
            'content' => '<h2>Destinasi Wisata Terbaik untuk Perjalanan Mobil</h2><p>Ada banyak destinasi menarik yang dapat Anda kunjungi dengan mobil rental. Berikut adalah beberapa rekomendasi:</p><h3>Pantai dan Pesisir</h3><p>Kunjungi pantai-pantai indah di sepanjang pesisir. Mobil rental memberi Anda kebebasan untuk berhenti di mana saja dan menikmati pemandangan yang menakjubkan.</p><h3>Pegunungan dan Alam Liar</h3><p>Jelajahi keindahan alam dengan berkendara ke daerah pegunungan. Perjalanan ini menawarkan pemandangan yang spektakuler dan pengalaman yang tak terlupakan.</p><h3>Kota Bersejarah</h3><p>Jelajahi kota-kota bersejarah dengan mobil rental Anda. Anda dapat menjelajahi tempat-tempat bersejarah dengan kecepatan Anda sendiri.</p>',
            'is_published' => true,
            'published_at' => now()->subDays(2),
        ]);
    }
}
