<?php
namespace App\Services;

class CsvService
{
    public function createCsv($data, ?array $csvHeader, $name)
    {
        // ヘッダーがいらない場合を考慮
        if ($csvHeader !== null) {
            array_unshift($data, $csvHeader);
        }

        // ファイルを開く
        $stream = fopen('php://temp', 'r+b');

        // ファイルに書き込む
        foreach ($data as $value) {
            fputcsv($stream, $value);
        }

        // ファイルポインタを先頭に
        rewind($stream);


        $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
        $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');

        // ファイル名作成
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $name . '.csv"',
        );


        return ['csv' => $csv, 'headers' => $headers];
    }
}