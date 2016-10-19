<?php

namespace App\Http\Controllers;

use App\Content;
use App\Jobs\StoreContent;
use Exception;
use Illuminate\Http\Request;

/**
 * Class ContentController
 *
 * @package App\Http\Controllers
 */
class ContentController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        try {
            $content         = $request->getContent();
            $storeContentJob = (StoreContent::fromApiJson($content))->onConnection('redis');
            $queueUid        = dispatch($storeContentJob);
        } catch (Exception $exception) {
           return response($exception->getMessage(), 400);
        }

        return response(json_encode(['uri' => '/queue/' . $queueUid]), 202);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $contents = Content::all();
        return response()->json($contents->toJson(), 200);
    }
}
