<?php

namespace App\Controller;

use App\Entity\User;
use Lcobucci\JWT\Token;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class RegisterController extends AbstractController{
    /**
     * @Route("/api/register", name= "api_register", methods={"POST"})
     */
    function index(Request $request ,  ValidatorInterface $validator){

        $data = json_decode($request->getContent(), true);
        if(!(isset($data['username']) && isset($data['password']) && isset($data['rePassword']) && isset($data['email']))){
            return $this->json(['error' => "Check post parameters."]);
        }
        $username = $data['username'];
        $password = $data['password'];
        $rePassword = $data['rePassword'];
        $email = $data['email'];

        $user = new User();

        $user->setUsername($username);
        $user->setPassword($password);
        $user->setEmail($email);
        $user->setRePassword($rePassword);

        $errors = $validator->validate($user);
        if(count($errors) > 0 ){
            $messages = [];
            foreach ($errors as $violation) {
                $messages[$violation->getPropertyPath()][] = $violation->getMessage();
            }
            return $this->json(['error' => true, 'messages' => $messages]);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(['id' => $user->getId()]);
    }

    /**
     * @Route("/api/checkToken",name= "api_check_token", methods={"POST"})
     */
    public function tokenChecker(){
        $user = $this->getUser();
        return !is_null($user);


    }

}