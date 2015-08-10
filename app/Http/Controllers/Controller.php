<?php namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;
use Doctrine\ORM\EntityManager as EntityManager;
use App\Models\Event as EventModel;
use Illuminate\Http\Request;

class Controller extends BaseController
{

  private $entityManager;

  public function __construct(EntityManager $entityManager) {
    $this->entityManager = $entityManager;
  }

  /**
   * Get an event as a json response
   *
   * @param $eventId
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function getEvent($eventId) {
    $eventRepository = $this->entityManager->getRepository('App\\Models\\Event');
    $event = $eventRepository->find($eventId);

    if ($event) {
      $transformedEvent = [
        'id' => $event->getId(),
        'title' => $event->getTitle()
      ];

      return response()->json($transformedEvent);
    } else {
      return response()->json(
        ['error' => TRUE, 'message' => 'Event not found'],
        404
      );
    }
  }

  public function createEvent(Request $request) {
    $event = new EventModel();
    $event->setTitle($request->input('title'));

    $this->entityManager->persist($event);
    $this->entityManager->flush();

    $transformedEvent = [
      'id' => $event->getId(),
      'title' => $event->getTitle()
    ];

    return response()->json($transformedEvent);
  }
}
