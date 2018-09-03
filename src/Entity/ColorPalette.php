<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ColorPaletteRepository")
 */
class ColorPalette
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $c_1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $c_2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $c_3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $c_4;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $c_5;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="integer")
     */
    private $views;

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getC1(): ?string
    {
        return $this->c_1;
    }

    public function setC1(string $c_1): self
    {
        $this->c_1 = $c_1;

        return $this;
    }

    public function getC2(): ?string
    {
        return $this->c_2;
    }

    public function setC2(string $c_2): self
    {
        $this->c_2 = $c_2;

        return $this;
    }

    public function getC3(): ?string
    {
        return $this->c_3;
    }

    public function setC3(string $c_3): self
    {
        $this->c_3 = $c_3;

        return $this;
    }

    public function getC4(): ?string
    {
        return $this->c_4;
    }

    public function setC4(string $c_4): self
    {
        $this->c_4 = $c_4;

        return $this;
    }

    public function getC5(): ?string
    {
        return $this->c_5;
    }

    public function setC5(string $c_5): self
    {
        $this->c_5 = $c_5;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(int $views): self
    {
        $this->views = $views;

        return $this;
    }
}
