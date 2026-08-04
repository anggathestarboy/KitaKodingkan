<?php namespace ItsAnggara\Localization\Updates;

use Schema;
use DB;
use Winter\Storm\Database\Updates\Migration;

class RecreateTranslationsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('itsanggara_localization_translations')) {
            Schema::create('itsanggara_localization_translations', function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('group')->default('header');
                $table->string('key');
                $table->text('value_id')->nullable();
                $table->text('value_en')->nullable();
                $table->timestamps();
                $table->unique(['group', 'key']);
            });
        }

        $translations = [
            ['header', 'nav_home', 'Beranda', 'Home'],
            ['header', 'nav_about', 'Tentang', 'About'],
            ['header', 'nav_privacy', 'Kebijakan', 'Privacy'],
            ['header', 'nav_services', 'Layanan', 'Services'],
            ['header', 'nav_projects', 'Proyek', 'Projects'],
            ['header', 'nav_blog', 'Blog', 'Blog'],
            ['header', 'cta_contact', 'Hubungi Kami', 'Contact Us'],
            ['footer', 'footer_tagline', 'Kami membantu bisnis Anda tumbuh lewat solusi digital yang sederhana, modern, dan tepat sasaran.', 'We help your business grow through simple, modern, and targeted digital solutions.'],
            ['footer', 'footer_col_services', 'Layanan', 'Services'],
            ['footer', 'footer_col_company', 'Perusahaan', 'Company'],
            ['footer', 'footer_col_contact', 'Hubungi Kami', 'Contact Us'],
            ['footer', 'footer_service_web', 'Pembuatan Website', 'Website Development'],
            ['footer', 'footer_service_mobile', 'Aplikasi Mobile', 'Mobile Applications'],
            ['footer', 'footer_service_uiux', 'Desain UI/UX', 'UI/UX Design'],
            ['footer', 'footer_service_system', 'Sistem Manajemen', 'Management Systems'],
            ['footer', 'footer_service_consult', 'Konsultasi Digital', 'Digital Consulting'],
            ['footer', 'footer_company_about', 'Tentang Kami', 'About Us'],
            ['footer', 'footer_company_portfolio', 'Portofolio', 'Portfolio'],
            ['footer', 'footer_company_blog', 'Blog', 'Blog'],
            ['footer', 'footer_company_career', 'Karir', 'Careers'],
            ['footer', 'footer_company_contact', 'Kontak', 'Contact'],
            ['footer', 'footer_contact_email', 'halo@kitakodingkan.com', 'halo@kitakodingkan.com'],
            ['footer', 'footer_contact_phone', '+62 812-3456-7890', '+62 812-3456-7890'],
            ['footer', 'footer_contact_address', 'Jakarta, Indonesia', 'Jakarta, Indonesia'],
            ['footer', 'footer_copyright', '© 2026 Kita Kodingkan. Semua hak dilindungi.', '© 2026 Kita Kodingkan. All rights reserved.'],
            ['footer', 'footer_privacy', 'Kebijakan Privasi', 'Privacy Policy'],
            ['footer', 'footer_terms', 'Syarat & Ketentuan', 'Terms & Conditions'],
        ];

        foreach ($translations as [$group, $key, $valueId, $valueEn]) {
            DB::table('itsanggara_localization_translations')->updateOrInsert(
                ['group' => $group, 'key' => $key],
                ['value_id' => $valueId, 'value_en' => $valueEn]
            );
        }
    }

    public function down()
    {
        Schema::dropIfExists('itsanggara_localization_translations');
    }
}
