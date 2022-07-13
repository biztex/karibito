<?php
namespace App\Services;

class TextFormatService
{
    /**
     * URLを<a>タグで囲む
     * 改行を<br>タグに変換
     * <a>タグと<br>タグをのみエスケープしないテキストを返す
     *
     * @param string $text
     * @return string
     */
    public function generateLinkFromSentence($text)
    {
        $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
        // 別タブで開きたいと要望あり
        $replace = '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>';
        $sanitizedText = e($text);
        $brTagGeneratedText = nl2br($sanitizedText);
        $aTagGeneratedText =  preg_replace($pattern, $replace, $brTagGeneratedText);
        $specificTagPermitText = strip_tags($aTagGeneratedText, '<a><br>');
        return $specificTagPermitText;
    }
}