<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UKM;

class UKMSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        $dataUKM = [
            ['nama_ukm' => 'UKM Basket',         'link_sosial_media' => 'basket.unikom.ac.id'],
            ['nama_ukm' => 'UKM Birama',         'link_sosial_media' => 'persbirama.unikom.ac.id'],
            ['nama_ukm' => 'UKM Bulu Tangkis',   'link_sosial_media' => 'badminton.unikom.ac.id'],
            ['nama_ukm' => 'UKM Catur UNIKOM',   'link_sosial_media' => 'catur.unikom.ac.id'],
            ['nama_ukm' => 'UKM Fotografi',      'link_sosial_media' => 'glosariumfoto.unikom.ac.id'],
            ['nama_ukm' => 'UKM Futsal',         'link_sosial_media' => 'futsalclub.unikom.ac.id'],
            ['nama_ukm' => 'UKM HIPMA',          'link_sosial_media' => 'hipma.unikom.ac.id'],
            ['nama_ukm' => 'UKM KMK',            'link_sosial_media' => 'kmk.unikom.ac.id'],
            ['nama_ukm' => 'UKM KPM',            'link_sosial_media' => 'kpm.unikom.ac.id'],
            ['nama_ukm' => 'UKM KSR',            'link_sosial_media' => 'ksr.unikom.ac.id'],
            ['nama_ukm' => 'UKM LDK UMMI',       'link_sosial_media' => 'ldkummi.unikom.ac.id'],
            ['nama_ukm' => 'UKM Mapaligi',       'link_sosial_media' => 'mapaligi.unikom.ac.id'],
            ['nama_ukm' => 'UKM Pencak Silat',   'link_sosial_media' => 'pencaksilat.unikom.ac.id'],
            ['nama_ukm' => 'UKM PMK',            'link_sosial_media' => 'pmk.unikom.ac.id'],
            ['nama_ukm' => 'UKM Pramuka',        'link_sosial_media' => 'pramuka.unikom.ac.id'],
            ['nama_ukm' => 'UKM PSM',            'link_sosial_media' => 'psm.unikom.ac.id'],
            ['nama_ukm' => 'UKM PTQ',            'link_sosial_media' => 'ptq.unikom.ac.id'],
            ['nama_ukm' => 'UKM Sadaya',         'link_sosial_media' => 'sadaya.unikom.ac.id'],
            ['nama_ukm' => 'UKM Sepak Bola',     'link_sosial_media' => 'sepakbola.unikom.ac.id'],
            ['nama_ukm' => 'UKM Taekwondo',      'link_sosial_media' => 'taekwondo.unikom.ac.id'],
            ['nama_ukm' => 'UKM Tarung Derajat', 'link_sosial_media' => 'tarungderajat.unikom.ac.id'],
            ['nama_ukm' => 'UKM YES',            'link_sosial_media' => 'yes.unikom.ac.id'],
        ];

        foreach ($dataUKM as $ukm) {
            UKM::create([
                'nama_ukm'         => $ukm['nama_ukm'],
                'deskripsi_ukm'    => 'Deskripsi ' . $ukm['nama_ukm'],
                'link_sosial_media'=> $ukm['link_sosial_media'],
            ]);
        }
    }
}
