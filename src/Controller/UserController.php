<?php
 namespace App\Controller;
 use App\Entity\CasinoUser;
 use App\Repository\CasinoUserRepository;
 use Doctrine\ORM\EntityManagerInterface;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\JsonResponse;

 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Routing\Annotation\Route;





 /**
  * Class UserController
  * @package App\Controller
  * @Route("/api", name="user_api")
  */
 class UserController extends AbstractController
 {
     /**
      * Returns a JSON response
      *
      * @param array $data
      * @param $status
      * @param array $headers
      * @return JsonResponse
      */
     public function response($data, $status = 200, $headers = ['Access-Control-Allow-Origin' => '*'])
     {
         return new JsonResponse($data, $status, $headers);
     }

     protected function transformJsonBody(\Symfony\Component\HttpFoundation\Request $request)
     {
         $data = json_decode($request->getContent(), true);

         if ($data === null) {
             return $request;
         }

         $request->request->replace($data);

         return $request;
     }

     /**
      * @return JsonResponse
      * @Route("/user-add", name="user_add", methods={"POST"})
      */
     public function addUserData(Request $request, EntityManagerInterface $entityManager, CasinoUserRepository $casinoUserRepository){
         $request = $this->transformJsonBody($request);
         if ($casinoUserRepository->findOneBy(['deviceID' => $request->get('deviceID')])){
             $data = [
                 'status' => 421,
                 'errors' => "user exists, skipped",
             ];
             return $this->response($data, 422);
         }else{
             $casinoUser= new CasinoUser();
             $casinoUser->setDeviceID($request->get('deviceID'));
             $casinoUser->setAmount($request->get('amount'));
             try{
                 $entityManager->persist($casinoUser);
                 $entityManager->flush();
                 $data = [
                     'status' => 201,
                     'success' => "User added successfully",
                 ];
                 return $this->response($data,201);
             }catch (\Exception $e){
                 $data = [
                     'status' => 422,
                     'errors' => $e->getMessage(),
                 ];
                 return $this->response($data, 422);
             }
         }
     }

     /**
      * @return JsonResponse
      * @Route("/getuser/{deviceID}", name="getuser", methods={"GET"})
      */
     public function getUserData(CasinoUserRepository $casinoUserRepository, $deviceID){
         $user = $casinoUserRepository->findOneBy(["deviceID" => $deviceID]);
//         $data = ['webview' => 'without button - on'];
//         return $this->response($data,200);
         try{
             $data = ['user'=>[
                 'deviceID' => $user->getDeviceID(),
                 'amount' =>$user->getAmount(),
             ]
             ];
             return $this->response($data,201);
         }catch (\Exception $e){
             $data = [
                 'status' => 404,
                 'errors' => $e->getMessage(),
             ];
             return $this->response($data, 404);
         }
     }

     /**
      * @return JsonResponse
      * @Route("/updateamount/{deviceID}/{amount}", name="updateamount", methods={"PUT"})
      */
     public function updateUserAmount(EntityManagerInterface $entityManager, CasinoUserRepository $casinoUserRepository, $deviceID, $amount){
         $user = $casinoUserRepository->findOneBy(["deviceID" => $deviceID]);
         try{
             $user->setAmount($user->getAmount() + $amount);
             $entityManager->persist($user);
             $entityManager->flush();
             $data = [
                 'status' => 202,
                 'success' => "amount updated successfully",
             ];
             return $this->response($data,202);
         }catch (\Exception $e){
             $data = [
                 'status' => 404,
                 'errors' => $e->getMessage(),
             ];
             return $this->response($data, 404);
         }
     }
 }