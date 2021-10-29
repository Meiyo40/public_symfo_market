<?php

namespace App\Controller;

use App\Classe\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/mon-panier", name="cart")
     */
    public function index(Cart $cart): Response
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $cart->getCompleteCart()
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="add_to_cart")
     * @param Cart $cart
     * @param $id
     * @return Response
     */
    public function add(Cart $cart, $id): Response
    {
        $cart->add($id);

        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart/minus/{id}", name="minus_from_cart")
     * @param Cart $cart
     * @return Response
     */
    public function minus($id, Cart $cart): Response
    {
        $cart->minus($id);

        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart/remove", name="remove_my_cart")
     * @param Cart $cart
     * @return Response
     */
    public function remove(Cart $cart): Response
    {
        $cart->remove();

        return $this->redirectToRoute('products');
    }

    /**
     * @Route("/cart/delete/{id}", name="delete_from_cart")
     * @param Cart $cart
     * @return Response
     */
    public function delete($id, Cart $cart): Response
    {
        $cart->delete($id);

        return $this->redirectToRoute('cart');
    }
}
