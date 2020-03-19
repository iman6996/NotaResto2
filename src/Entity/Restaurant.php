<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RestaurantRepository")
 */
class Restaurant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="restaurants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RestaurantPicture", mappedBy="restaurant", orphanRemoval=true)
     */
    private $restaurantPictures;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Feedback", mappedBy="restaurant", orphanRemoval=true)
     */
    private $feedbacks;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function getAverageRating() : float
{

    $sum = 0;
    $total = 0;
  
   

    foreach($this->getFeedbacks() as $feedback) {
        $sum += $feedback->getRating();
        $total++;
    }
    if ($total > 0) {
        return $sum/$total;
    }

    return 0;
}

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }
public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
        $this->restaurantPictures = new ArrayCollection();
        $this->feedbacks = new ArrayCollection();
    }

    /**
     * @return Collection|RestaurantPicture[]
     */
    public function getRestaurantPictures(): Collection
    {
        return $this->restaurantPictures;
    }

    public function addRestaurantPicture(RestaurantPicture $restaurantPicture): self
    {
        if (!$this->restaurantPictures->contains($restaurantPicture)) {
            $this->restaurantPictures[] = $restaurantPicture;
            $restaurantPicture->setRestaurant($this);
        }

        return $this;
    }

    public function removeRestaurantPicture(RestaurantPicture $restaurantPicture): self
    {
        if ($this->restaurantPictures->contains($restaurantPicture)) {
            $this->restaurantPictures->removeElement($restaurantPicture);
            // set the owning side to null (unless already changed)
            if ($restaurantPicture->getRestaurant() === $this) {
                $restaurantPicture->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Feedback[]
     */
    public function getFeedbacks(): Collection
    {
        return $this->feedbacks;
    }

    public function addFeedback(Feedback $feedback): self
    {
        if (!$this->feedbacks->contains($feedback)) {
            $this->feedbacks[] = $feedback;
            $feedback->setRestaurant($this);
        }

        return $this;
    }

    public function removeFeedback(Feedback $feedback): self
    {
        if ($this->feedbacks->contains($feedback)) {
            $this->feedbacks->removeElement($feedback);
            // set the owning side to null (unless already changed)
            if ($feedback->getRestaurant() === $this) {
                $feedback->setRestaurant(null);
            }
        }

        return $this;
    }
}
