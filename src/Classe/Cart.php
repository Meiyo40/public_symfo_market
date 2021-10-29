<?php

namespace App\Classe;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart {
    private $session;
    private $entityManager;

    public function __construct(SessionInterface $session, EntityManagerInterface $entityManager)
    {
        $this->session = $session;
        $this->entityManager = $entityManager;
    }

    public function add($item){
        $cart = $this->session->get('cart', []);

        if(!empty($cart[$item])) {
            $cart[$item]++;
        } else {
            $cart[$item] = 1;
        }

        $this->session->set('cart', $cart);
    }

    public function minus($item){
        $cart = $this->session->get('cart', []);

        if(!empty($cart[$item])) {
            $cart[$item]--;
            if($cart[$item] <= 0) {
                unset($cart[$item]);
            }
        }

        $this->session->set('cart', $cart);
    }

    public function get() {
        return $this->session->get('cart');
    }

    public function remove() {
        return $this->session->remove('cart');
    }

    public function delete($id) {
        $cart = $this->session->get('cart', []);

        unset($cart[$id]);

        return $this->session->set('cart', $cart);
    }

    /**
     * @return array
     */
    public function getCompleteCart() : array {
        $cartComplete = [];

        if ($this->get()) {
            foreach ($this->get() as $id => $quantity) {
                $product = $this->entityManager->getRepository(Product::class)->findOneById($id);

                if (!$product) {
                    $this->delete($id);
                } else {
                    $cartComplete[] = [
                        'product' => $product,
                        'quantity' => $quantity
                    ];
                }
            }
        }
        return $cartComplete;
    }
}