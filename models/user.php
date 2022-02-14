<?php

class User {
    private int $user_id;
    private string $email;
    private array $lectures;

    public function __set($id, $value) {}

    public function setLectures($lectures)
    {
        $this->lectures = $lectures;
    }

    public function getId(): int
    {
        return $this->user_id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getLectures(): array
    {
        return $this->lectures;
    }
}