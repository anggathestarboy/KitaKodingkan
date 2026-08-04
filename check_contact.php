<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$keys = ItsAnggara\Localization\Models\Translation::where('group', 'contact')->get(['key', 'value_id', 'value_en']);
echo "Contact translation keys:\n";
foreach ($keys as $k) {
    echo "  [{$k->key}] id: {$k->value_id} | en: {$k->value_en}\n";
}
if ($keys->isEmpty()) {
    echo "  (none found)\n";
}

echo "\nChecking table:\n";
echo Schema::hasTable('itsanggara_content_contact_submissions') ? "  TABLE EXISTS\n" : "  TABLE MISSING\n";

echo "\nRecent submissions:\n";
$rows = DB::table('itsanggara_content_contact_submissions')->latest()->limit(5)->get();
foreach ($rows as $r) {
    echo "  {$r->name} | {$r->email} | {$r->service_need}\n";
}
if ($rows->isEmpty()) {
    echo "  (none)\n";
}
