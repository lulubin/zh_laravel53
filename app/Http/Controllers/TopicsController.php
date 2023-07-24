<?php

namespace App\Http\Controllers;

use App\Repositories\TopicRepository;

class TopicsController extends Controller
{
    protected $topicRepository;

    public function __construct(TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    public function index()
    {
        return $this->topicRepository->getTopicsForTagging();
    }
}