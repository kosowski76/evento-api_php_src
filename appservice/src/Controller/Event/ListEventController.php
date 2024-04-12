<?php

namespace Evento\Controller\Event;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListEventController extends AbstractController
{

//    private ListEventHandler $listEventHandler;
//    private EventRepositoryInterface $eventRepository;
//
//    public function __construct(
//        ListEventHandler $listEventHandler,
//        EventRepositoryInterface $eventRepository
//    )
//    {
//        $this->listEventHandler = $listEventHandler;
//        $this->eventRepository = $eventRepository;
//    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function index(Request $request): JsonResponse
    {
        $allEvents = [];

        return new JsonResponse($allEvents);
    }


}