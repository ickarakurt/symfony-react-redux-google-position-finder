<?php

namespace App\Controller;



use App\Entity\Keyword;
use App\Entity\Project;
use App\Entity\Rank;
use App\Extra\GooglePositionFinder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class KeywordCountroller extends  \Symfony\Bundle\FrameworkBundle\Controller\AbstractController{

    /**
     * @Route("api/keyword", methods={"POST"})
     */
    public function add(Request $request)  {

        $data = json_decode($request->getContent(), true);
        $url = $data['website'];
        $word = $data['keyword'];
        $country = $data['country'];

        $manager  = $this->getDoctrine()->getManager();
        $project = $manager->getRepository(Project::class)->findOneBy(['url' => $url]);
        $keyword = new Keyword($project);
        $keyword->setCountry($country);
        $keyword->setKeyword($word);
        $manager->persist($keyword);
        $manager->flush();
        $this->updatePosition($keyword);
         return $this->json([ 'id' => $keyword->getId()]);
    }


    private function updatePosition(Keyword $keyword): void{

        $positionFinder = new GooglePositionFinder();
        $manager  = $this->getDoctrine()->getManager();
        $project = $this->getDoctrine()->getRepository(Project::class)->findOneBy(['id' => $keyword->getProject()]);
        $position = $positionFinder->get($keyword->getKeyword(),$keyword->getCountry(),$project->getUrl());
        $position = is_null($position) ? 0 : $position;
        $rank = new Rank($keyword);
        $rank->setPosition($position) ;
        $manager->persist($rank);
        $manager->flush();
    }

    /**
     * @Route("api/updatekeyword", methods={"POST"})
     */
    public function updateRank(Request $request){
        $data = json_decode($request->getContent(), true);
        $id = $data['id'];
        $manager = $this->getDoctrine()->getManager();
        $keyword = $manager->getRepository(Keyword::class)->find($id);
        $this->updatePosition($keyword);
        $findBestPosition = $manager->getRepository(Rank::class)->findBestPosition($keyword);
        $findLastPosition = $manager->getRepository(Rank::class)->findLatestPosition($keyword);
        $arr = [
            "id" => $id,
            "keyword" => $keyword->getKeyword(),
            "bestPosition" => (is_null($findBestPosition) ? "-" : $findBestPosition->getPosition() ),
            "lastPosition" =>
                [
                    "date" =>  $findLastPosition->getCreatedAt()->format('Y-m-d H:i:s') ,
                    "position" => (($findLastPosition->getPosition() == 0) ? "-" : $findLastPosition->getPosition() )
                ]
        ];
        return $this->json($arr);
    }

}