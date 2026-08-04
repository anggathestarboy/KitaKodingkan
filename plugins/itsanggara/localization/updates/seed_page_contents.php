<?php namespace ItsAnggara\Localization\Updates;

use DB;
use Winter\Storm\Database\Updates\Migration;

class SeedPageContents extends Migration
{
    public function up()
    {
        $content = '<h1 id="kebijakan-privasi">Kebijakan Privasi</h1>
<p>Halaman ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda saat menggunakan layanan kami. Kami berkomitmen untuk menjaga privasi Anda dengan penuh tanggung jawab.</p>
<hr/>
<h2 id="pengumpulan-data">1. Pengumpulan Informasi</h2>
<p>Kami mengumpulkan beberapa jenis informasi untuk memberikan dan meningkatkan layanan kami kepada Anda.</p>
<h3 id="jenis-data">Jenis Data yang Dikumpulkan</h3>
<p>Informasi pribadi mencakup nama, alamat email, nomor telepon, serta data log teknis peramban Anda.</p>
<h3 id="metode-pengumpulan">Metode Pengumpulan</h3>
<p>Data dikumpulkan langsung saat Anda mengisi formulir registrasi, menghubungi layanan pelanggan, atau melalui kue (cookies).</p>
<h2 id="penggunaan-data">2. Penggunaan Informasi</h2>
<p>Informasi yang kami kumpulkan digunakan untuk mengoperasikan situs, memberikan dukungan pelanggan, serta menganalisis performa platform.</p>
<h2 id="keamanan-data">3. Keamanan Data</h2>
<p>Kami menerapkan langkah-langkah enkripsi dan protokol keamanan standar industri untuk melindungi data pribadi Anda.</p>
<h2 id="hubungi-kami">4. Hubungi Kami</h2>
<p>Jika Anda memiliki pertanyaan mengenai Kebijakan Privasi ini, silakan hubungi kami melalui saluran layanan pelanggan resmi.</p>';

        $contentEn = '<h1 id="privacy-policy">Privacy Policy</h1>
<p>This page explains how we collect, use, and protect your personal information when you use our services. We are committed to protecting your privacy with full responsibility.</p>
<hr/>
<h2 id="information-collection">1. Information Collection</h2>
<p>We collect several types of information to provide and improve our services to you.</p>
<h3 id="types-of-data">Types of Data Collected</h3>
<p>Personal information includes your name, email address, phone number, and your browser technical log data.</p>
<h3 id="collection-methods">Collection Methods</h3>
<p>Data is collected directly when you fill out a registration form, contact customer service, or through cookies.</p>
<h2 id="information-use">2. Information Use</h2>
<p>The information we collect is used to operate the site, provide customer support, and analyze platform performance.</p>
<h2 id="data-security">3. Data Security</h2>
<p>We implement encryption measures and standard industry security protocols to protect your personal data.</p>
<h2 id="contact-us">4. Contact Us</h2>
<p>If you have any questions about this Privacy Policy, please contact us through our official customer service channels.</p>';

        DB::table('itsanggara_localization_page_contents')->updateOrInsert(
            ['slug' => 'kebijakan-privasi'],
            [
                'title'      => 'Kebijakan Privasi',
                'content'    => $content,
                'title_en'   => 'Privacy Policy',
                'content_en' => $contentEn,
            ]
        );
    }

    public function down()
    {
        DB::table('itsanggara_localization_page_contents')->where('slug', 'kebijakan-privasi')->delete();
    }
}
