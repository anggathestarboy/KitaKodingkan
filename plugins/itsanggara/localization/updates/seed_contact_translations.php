<?php namespace ItsAnggara\Localization\Updates;

use Winter\Storm\Database\Updates\Migration;
use Illuminate\Support\Facades\DB;

class SeedContactTranslations extends Migration
{
    public function up()
    {
        $translations = [
            ['contact', 'title', 'Hubungi Kami', 'Contact Us'],
            ['contact', 'subtitle', 'Ada pertanyaan atau ingin memulai proyek digital bersama kami? Kirimkan pesan Anda.', 'Have questions or want to start a digital project with us? Send us a message.'],
            ['contact', 'label_name', 'Nama Lengkap', 'Full Name'],
            ['contact', 'placeholder_name', 'Masukkan nama lengkap Anda', 'Enter your full name'],
            ['contact', 'label_email', 'Alamat Email', 'Email Address'],
            ['contact', 'placeholder_email', 'contoh@email.com', 'example@email.com'],
            ['contact', 'label_service', 'Kebutuhan Proyek', 'Project Need'],
            ['contact', 'option_select', '-- Pilih Kebutuhan --', '-- Select Need --'],
            ['contact', 'option_web', 'Pengembangan Website', 'Website Development'],
            ['contact', 'option_mobile', 'Aplikasi Mobile', 'Mobile Applications'],
            ['contact', 'option_custom', 'Aplikasi Custom', 'Custom Application'],
            ['contact', 'label_message', 'Pesan Anda', 'Your Message'],
            ['contact', 'placeholder_message', 'Ceritakan detail proyek atau kebutuhan Anda...', 'Tell us about your project or needs...'],
            ['contact', 'btn_submit', 'Kirim Pesan', 'Send Message'],
            ['contact', 'success_message', 'Terima kasih! Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.', 'Thank you! Your message has been sent successfully. We will get back to you soon.'],
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
    }
}
