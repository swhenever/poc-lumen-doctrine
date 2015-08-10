<?php
/**
 * Created by PhpStorm.
 * User: jmortenson
 * Date: 8/9/15
 * Time: 5:15 PM
 */

namespace App\Models;
use Doctrine\ORM\Mapping as ORM;

/**
  * @ORM\Entity
  * @ORM\Table(name="events")
  */
class Event {
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue
   * @var int
   */
  private $id;

  /**
   * @ORM\Column(type="string", name="title", nullable=false)
   * @var string
   */
  private $title;

  public function getId() {
    return $this->id;
  }

  public function setTitle($title) {
    $this->title = $title;
  }

  public function getTitle() {
    return $this->title;
  }
}