<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            ['name' => 'Toyota Avanza 2023', 'description' => 'Mobil keluarga dengan kapasitas 7 penumpang, nyaman untuk perjalanan jarak jauh', 'price_per_day' => 350000, 'transmission' => 'Matic', 'capacity' => 7, 'status' => 'Tersedia'],
            ['name' => 'Honda CR-V 2023', 'description' => 'SUV premium dengan fitur lengkap dan keselamatan terdepan', 'price_per_day' => 550000, 'transmission' => 'Matic', 'capacity' => 5, 'status' => 'Tersedia'],
            ['name' => 'Daihatsu Xenia 2022', 'description' => 'Mobil keluarga ekonomis dengan ruang kabin luas', 'price_per_day' => 300000, 'transmission' => 'Matic', 'capacity' => 7, 'status' => 'Tersedia'],
            ['name' => 'Suzuki Ertiga 2023', 'description' => 'Kendaraan serbaguna dengan efisiensi bahan bakar tinggi', 'price_per_day' => 380000, 'transmission' => 'Matic', 'capacity' => 7, 'status' => 'Tersedia'],
            ['name' => 'Mitsubishi Xpander 2023', 'description' => 'MPV modern dengan desain mewah dan performa tangguh', 'price_per_day' => 450000, 'transmission' => 'Matic', 'capacity' => 7, 'status' => 'Tersedia'],
            ['name' => 'Toyota Innova 2022', 'description' => 'Mobil dinas dengan kualitas terjamin dan kapasitas besar', 'price_per_day' => 500000, 'transmission' => 'Matic', 'capacity' => 8, 'status' => 'Tersedia'],
            ['name' => 'Hyundai Creta 2023', 'description' => 'SUV subkompak dengan teknologi terkini dan harga terjangkau', 'price_per_day' => 480000, 'transmission' => 'Matic', 'capacity' => 5, 'status' => 'Tersedia'],
            ['name' => 'Kia Seltos 2023', 'description' => 'SUV modern dengan desain futuristik dan interior luas', 'price_per_day' => 500000, 'transmission' => 'Matic', 'capacity' => 5, 'status' => 'Tersedia'],
            ['name' => 'Toyota Fortuner 2023', 'description' => 'SUV besar dengan kemampuan medan dan interior premium', 'price_per_day' => 650000, 'transmission' => 'Matic', 'capacity' => 7, 'status' => 'Tersedia'],
            ['name' => 'Honda Jazz 2022', 'description' => 'City car kompak dengan performa responsif dan hemat bahan bakar', 'price_per_day' => 400000, 'transmission' => 'Matic', 'capacity' => 5, 'status' => 'Tersedia'],
            ['name' => 'Daihatsu Terios 2023', 'description' => 'SUV kompak dengan sistem 4x4 dan ground clearance tinggi', 'price_per_day' => 420000, 'transmission' => 'Manual', 'capacity' => 5, 'status' => 'Tersedia'],
            ['name' => 'Suzuki Vitara 2022', 'description' => 'SUV stylish dengan performa dinamis dan hemat energi', 'price_per_day' => 490000, 'transmission' => 'Matic', 'capacity' => 5, 'status' => 'Tersedia'],
            ['name' => 'Toyota Camry 2023', 'description' => 'Sedan premium dengan teknologi hybrid dan interior mewah', 'price_per_day' => 700000, 'transmission' => 'Matic', 'capacity' => 5, 'status' => 'Tersedia'],
            ['name' => 'Honda Civic 2023', 'description' => 'Sedan sport dengan performa tinggi dan handling responsif', 'price_per_day' => 650000, 'transmission' => 'Matic', 'capacity' => 5, 'status' => 'Tersedia'],
            ['name' => 'Nissan Serena 2022', 'description' => 'Minivan keluarga dengan ruang kabin yang sangat luas', 'price_per_day' => 520000, 'transmission' => 'Matic', 'capacity' => 8, 'status' => 'Tersedia'],
            ['name' => 'Isuzu Panther 2023', 'description' => 'Minibus kokoh dengan performa andal untuk transportasi grup', 'price_per_day' => 450000, 'transmission' => 'Manual', 'capacity' => 8, 'status' => 'Tersedia'],
            ['name' => 'Wuling Cortez 2023', 'description' => 'LCGC dengan ruang luas dan harga sangat kompetitif', 'price_per_day' => 380000, 'transmission' => 'Matic', 'capacity' => 7, 'status' => 'Tersedia'],
            ['name' => 'MG Hector 2022', 'description' => 'SUV besar dengan teknologi smart car dan interior premium', 'price_per_day' => 550000, 'transmission' => 'Matic', 'capacity' => 5, 'status' => 'Tersedia'],
            ['name' => 'Chery Tiggo 8 2023', 'description' => 'SUV 7 tempat dengan harga bersaing dan fitur lengkap', 'price_per_day' => 500000, 'transmission' => 'Matic', 'capacity' => 7, 'status' => 'Tersedia'],
            ['name' => 'BYD Song Plus DM 2023', 'description' => 'SUV hybrid plug-in dengan efisiensi bahan bakar optimal', 'price_per_day' => 480000, 'transmission' => 'Matic', 'capacity' => 5, 'status' => 'Tersedia'],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
