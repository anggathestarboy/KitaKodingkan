<?php namespace ItsAnggara\Localization\Updates;

use Winter\Storm\Database\Updates\Migration;
use Illuminate\Support\Facades\DB;

class SeedContactModalTranslations extends Migration
{
    public function up()
    {
        $translations = [
            ['contact', 'modal_success_title', 'Pesan Terkirim!', 'Message Sent!'],
            ['contact', 'modal_error_title', 'Gagal Mengirim', 'Send Failed'],
            ['contact', 'modal_ok', 'OK', 'OK'],
            ['contact', 'error_required', 'Semua kolom wajib diisi.', 'All fields are required.'],
            ['contact', 'error_invalid_email', 'Format email tidak valid.', 'Invalid email format.'],
            ['contact', 'error_failed', 'Terjadi kesalahan. Silakan coba lagi.', 'Something went wrong. Please try again.'],
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