<?php

namespace App\Entities;

/**
 * @Entity
 * @Table(name="ads")
 */
class Ad
{
  /**
   * @var int $id
   *
   * @Id
   * @Column(type="integer")
   * @GeneratedValue
   */
    private int $id;

  /**
   * @var string $text
   *
   * @Column(type="string")
   */
    private string $text;

  /**
   * @var int $price
   *
   * @Column(type="integer")
   */
    private int $price;

  /**
   * @var int $shows_limit
   *
   * @Column(type="integer", options={"comment": "Limit of shows"})
   */
    private int $shows_limit;

  /**
   * @var string $banner
   *
   * @Column(type="string")
   */
    private string $banner;

  /**
   * @var int $shows
   *
   * @Column(type="integer", options={"default": 0})
   */
    private int $shows = 0;

  /**
   * @return int
   */
    public function getId(): int
    {
        return $this->id;
    }

  /**
   * @param  int $id
   * @return void
   */
    public function setId(int $id)
    {
        $this->id = $id;
    }

  /**
   * @return string
   */
    public function getText(): string
    {
        return $this->text;
    }

  /**
   * @param  string $text
   * @return void
   */
    public function setText(string $text)
    {
        $this->text = $text;
    }

  /**
   * @return int
   */
    public function getPrice(): int
    {
        return $this->price;
    }

  /**
   * @param  int $price
   * @return void
   */
    public function setPrice(int $price)
    {
        $this->price = $price;
    }

  /**
   * @return int
   */
    public function getLimit(): int
    {
        return $this->shows_limit;
    }

  /**
   * @param  int $limit
   * @return void
   */
    public function setLimit(int $limit)
    {
        $this->shows_limit = $limit;
    }

  /**
   * @return string
   */
    public function getBanner(): string
    {
        return $this->banner;
    }

  /**
   * @param  string $banner
   * @return void
   */
    public function setBanner(string $banner)
    {
        $this->banner = $banner;
    }

  /**
   * @return int
   */
    public function getShows(): int
    {
        return $this->shows;
    }

  /**
   * @param  int $shows
   * @return void
   */
    public function setShows(int $shows)
    {
        $this->shows = $shows;
    }
}
