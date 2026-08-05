<?php namespace ItsAnggara\Localization\Updates;

use DB;
use Winter\Storm\Database\Updates\Migration;

class SeedPageTitles extends Migration
{
    public function up()
    {
        $pages = [
            'home' => [
                'title'          => 'Beranda',
                'title_en'       => 'Home',
                'description'    => 'Kami membangun website dan aplikasi yang membantu bisnis Anda berkembang. Murah, cepat, dan tepat sasaran.',
                'description_en' => 'We build websites and applications that help your business grow. Affordable, fast, and on target.',
            ],
            'tentang-kami' => [
                'title'          => 'Tentang Kami',
                'title_en'       => 'About Us',
                'description'    => 'Ketahui lebih lanjut tentang kami',
                'description_en' => 'Learn more about us',
            ],
            'hubungi-kami' => [
                'title'          => 'Hubungi Kami',
                'title_en'       => 'Contact Us',
                'description'    => 'Hubungi kami untuk konsultasi dan kebutuhan proyek digital Anda',
                'description_en' => 'Contact us for consultation and your digital project needs',
            ],
            'proyek' => [
                'title'          => 'Proyek Kami',
                'title_en'       => 'Our Projects',
                'description'    => 'Kami berhasil meluncurkan proyek yang berupa solusi digital untuk membantu bisnis mereka',
                'description_en' => 'We have successfully launched projects that are digital solutions to help their businesses',
            ],
            'blog' => [
                'title'          => 'Blog',
                'title_en'       => 'Blog',
                'description'    => 'Artikel, tips, dan panduan seputar dunia digital untuk pemilik bisnis. Bahasa sederhana, langsung bisa dipraktikkan.',
                'description_en' => 'Articles, tips, and guides about the digital world for business owners. Simple language, ready to practice.',
            ],
            'kebijakan-privasi' => [
                'title'          => 'Kebijakan Privasi',
                'title_en'       => 'Privacy Policy',
                'description'    => 'Ketahui lebih lanjut tentang kebijakan privasi dari tim kami',
                'description_en' => 'Learn more about our privacy policy',
            ],
        ];

        foreach ($pages as $slug => $data) {
            DB::table('itsanggara_localization_page_contents')->updateOrInsert(
                ['slug' => $slug],
                [
                    'is_active'      => true,
                    'title'          => $data['title'],
                    'title_en'       => $data['title_en'],
                    'description'    => $data['description'],
                    'description_en' => $data['description_en'],
                ]
            );
        }
    }

    public function down()
    {
        // Nothing to undo - the seed data is harmless.
    }
}
