<?php namespace ItsAnggara\Localization\Updates;

use Winter\Storm\Database\Updates\Migration;
use Illuminate\Support\Facades\DB;

class SeedBlogProjectTranslations extends Migration
{
    public function up()
    {
        $translations = [
            // ===================== BLOG PAGE =====================
            ['blog', 'search_results_header', 'Hasil Pencarian', 'Search Results'],
            ['blog', 'search_results_desc', ':count artikel ditemukan untuk kata kunci dan filter yang dipilih', ':count articles found for the selected keywords and filters'],
            ['blog', 'other_header', 'Artikel Lainnya', 'More Articles'],
            ['blog', 'other_subtitle', 'Jelajahi lebih banyak artikel yang kami tulis untuk Anda', 'Explore more of the articles we write for you'],
            ['blog', 'search_placeholder', 'Cari artikel...', 'Search articles...'],
            ['blog', 'all_categories', 'Semua Kategori', 'All Categories'],
            ['blog', 'filter_btn', 'Filter', 'Filter'],
            ['blog', 'reset_btn', 'Reset', 'Reset'],
            ['blog', 'read_article', 'Baca Artikel', 'Read Article'],
            ['blog', 'featured_label', 'Artikel Terbaru', 'Latest Article'],
            ['blog', 'no_image', 'Tidak ada gambar', 'No image'],
            ['blog', 'read_more', 'Selengkapnya', 'Read More'],
            ['blog', 'empty_title', 'Tidak Ada Artikel', 'No Articles'],
            ['blog', 'empty_desc', 'Belum ada artikel yang cocok dengan pencarian atau filter kamu.', 'No articles match your search or filter.'],
            ['blog', 'reset_search', 'Reset Pencarian', 'Reset Search'],

            // ===================== PROJECT PAGE =====================
            ['project', 'search_results_header', 'Hasil Pencarian', 'Search Results'],
            ['project', 'search_results_desc', ':count proyek ditemukan untuk kata kunci dan filter yang dipilih', ':count projects found for the selected keywords and filters'],
            ['project', 'other_header', 'Proyek Lainnya', 'More Projects'],
            ['project', 'other_subtitle', 'Jelajahi lebih banyak karya yang telah kami kerjakan', 'Explore more of the work we have done'],
            ['project', 'search_placeholder', 'Cari proyek...', 'Search projects...'],
            ['project', 'all_categories', 'Semua Kategori', 'All Categories'],
            ['project', 'filter_btn', 'Filter', 'Filter'],
            ['project', 'reset_btn', 'Reset', 'Reset'],
            ['project', 'view_detail', 'Lihat Detail Proyek', 'View Project Details'],
            ['project', 'featured_label', 'Proyek Terbaru', 'Latest Project'],
            ['project', 'no_image', 'Tidak ada gambar', 'No image'],
            ['project', 'read_more', 'Selengkapnya', 'Read More'],
            ['project', 'empty_title', 'Tidak Ada Proyek', 'No Projects'],
            ['project', 'empty_desc', 'Belum ada proyek yang cocok dengan pencarian atau filter kamu.', 'No projects match your search or filter.'],
            ['project', 'reset_search', 'Reset Pencarian', 'Reset Search'],
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
        // Nothing to undo - the seed data is harmless.
    }
}
