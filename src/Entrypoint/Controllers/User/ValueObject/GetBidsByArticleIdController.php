<?php


namespace IESLaCierva\Entrypoint\Controllers\User\ValueObject;


use IESLaCierva\Application\User\ValueObject\GetBidsByArticleId\GetBidsByArticleIdService;
use IESLaCierva\Infrastructure\Files\BidsRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetBidsByArticleIdController
{
    public function __construct()
    {
        $this->service = new GetBidsByArticleIdService(new BidsRepository());
    }

    public function execute(Request $request): Response
    {
        $userId = $request->get('id');
        $user = $this->service->execute($userId);
        return new JsonResponse($user);
    }
}