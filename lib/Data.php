<?php


class Data
{
    private $name;
    private $restaurant;

    private $email;

    private $comment;

    public function __construct($name, $restaurant, $email, $comment)//do not refer to our other variables, just locals
    {
        $this->name = $name;
        $this->restaurant = $restaurant;
        $this->email = $email;
        $this->comment = $comment;
    }

    public function getName() {return $this->name;}
    public function getRestaurant() {return $this->restaurant;}
    public function getEmail() {return $this->email;}
    public function getComment() {return $this->comment;}
}