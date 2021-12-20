<?php

namespace App\Entities;

/**
 * @Entity
 * @Table(name="ads")
 */
class Ad
{
  /**
   * @Id
   * @Column(type="integer")
   * @GeneratedValue
   */
  private $id;

  /**
   * @Column(type="string")
   */
  private $name;

  /**
   * @Column(type="integer")
   */
  private $price;

  /**
   * @Column(type="integer", options={"comment":"Limit of shows"})
   */
  private $limit;

  /**
   * @Column(type="string")
   */
  private $banner;

  /**
   * @Column(type="integer")
   */
  private $shows;
}
