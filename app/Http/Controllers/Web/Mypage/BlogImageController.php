<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Services\BlogImageService;
use Illuminate\Http\Request;

class BlogImageController extends Controller
{
    /**
     * @var BlogImageService
     */
    private $blog_image_service;

    /**
     * @param BlogImageService $blog_image_service
     */
    public function __construct(BlogImageService $blog_image_service)
    {
        $this->blog_image_service = $blog_image_service;
    }

    /**
     * 画像保存
     *
     * @param Request $request
     * @return string|false
     */
    protected function store(Request $request)
    {
        $url = $this->blog_image_service->uploadImage($request);

        return json_encode(['location' => $url]);
    }
}
