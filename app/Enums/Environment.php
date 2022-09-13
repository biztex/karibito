<?php

namespace App\Enums;

/**
 * 環境を管理するEnum
 */
enum Environment: string
{
    // 利用可能なAPP_ENVを列挙
    case LOCAL = 'local'; // ローカル環境
    case DEVELOPMENT = 'development'; // 自社確認環境
    case STAGE = 'stage'; // クライアント向け確認環境
    case PRODUCTION = 'production'; // 本番環境

    // 本番環境以外の環境
    const IS_ENABLE_EASY_LOGIN_ENVS = [
        self::LOCAL,
        self::DEVELOPMENT,
//        self::STAGE,
    ];

    /**
     * 簡易ログイン可能な環境かどうか
     * @return bool
     */
    public static function isEnableEasyLogin(): bool
    {
        return in_array(self::from(config('app.env')), self::IS_ENABLE_EASY_LOGIN_ENVS, true);
    }
}