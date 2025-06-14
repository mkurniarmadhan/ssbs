<?php

namespace Domain;

class Booking
{
  public function __construct(public string $name, public string $email, public string $date)
  {
    $this->name = $name;
    $this->email = $email;
    $this->date = $date;
  }
}
