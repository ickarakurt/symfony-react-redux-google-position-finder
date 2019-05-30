<?php

namespace App\Controller;



use App\Entity\Keyword;
use App\Entity\Project;
use App\Entity\Rank;
use App\Extra\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends  \Symfony\Bundle\FrameworkBundle\Controller\AbstractController{

    /**
     * @Route("api/project", methods={"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function add(Request $request){

        $data = json_decode($request->getContent(), true);

        $url = $data["url"];
        $project = new Project($this->getUser());
        $project->setUrl($url);
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($project);
        $manager->flush();

        return $this->json($project);
    }

    /**
     * @Route("api/project", methods={"GET"})
     */
    public function getProjects(){
        $manager = $this->getDoctrine()->getManager();
        $projects = $manager->getRepository(Project::class)->findBy(['user' => $this->getUser()]);
        return $this->json($projects);
    }

    /**
     * @Route("api/project/position", methods={"POST"})
     */
    public function delete(Request $request){

        return $this->json($request);
    }

    /**
     * @Route("api/project/{url}", methods={"GET"})
     */
    public function getKeywords($url){

        $manager = $this->getDoctrine()->getManager();
        $project = $manager->getRepository(Project::class)->findOneBy(['url' => $url]);
        $keywords = $manager->getRepository(Keyword::class)->findBy(['project' => $project]);
        $answerArray = [];
        foreach ($keywords as $keyword){
            $findBestPosition = $manager->getRepository(Rank::class)->findBestPosition($keyword);
            $findLastPosition = $manager->getRepository(Rank::class)->findLatestPosition($keyword);

            $answerArray[$keyword->getId()] =  [
                "id" => $keyword->getId(),
                "keyword" => $keyword->getKeyword(),
                "bestPosition" => (is_null($findBestPosition) ? "-" : $findBestPosition->getPosition() ),
                "lastPosition" =>
                    [
                        "date" =>  $findLastPosition->getCreatedAt()->format('Y-m-d H:i:s') ,
                        "position" => (($findLastPosition->getPosition() == 0) ? "-" : $findLastPosition->getPosition() )
                    ]
            ];
        }
        return $this->json($answerArray);
    }




}