<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use \Datetime;

use App\Entity\ColorPalette;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="landing")
     */
    public function index()
    {
        //$repository = $this->getDoctrine()->getRepository(ColorPalette::class);
        //$colors = $repository->findAll();

        $colors = $this->getDoctrine()
            ->getRepository(ColorPalette::class)
            ->findPopular();
        dump($colors);

        return $this->render('default/index.html.twig', [
            'colors' => $colors,
        ]);
    }

    /**
     * @Route("/palette/{id}", name="palette")
     */
    public function showScheme(Request $request, $id)
    {
        // Get list of invited made by current user
        $repo = $this->getDoctrine()->getRepository(ColorPalette::class);
        $palette = $repo->find($id);

        if ($palette)
        {

            // Increment Views
            $views = $palette->getViews();
            $views += 1;
            $palette->setViews($views);
            $em = $this->getDoctrine()->getManager();
            $em->persist($palette);
            $em->flush();

            $css = "// CSS Properties \n\n--color-1: " . $palette->getC1() . "\n--color-2: " . $palette->getC2() . "\n--color-3: " . $palette->getC3() . "\n--color-4: " . $palette->getC4() . "\n--color-5: " . $palette->getC5();
            $sass = "// SCSS Variables \n\n\$color-1: " . $palette->getC1() . "\n\$color-2: " . $palette->getC2() . "\n\$color-3: " . $palette->getC3() . "\n\$color-4: " . $palette->getC4() . "\n\$color-5: " . $palette->getC5();            
            $swift = "// Swift Variables \n\nlet color1 = " . $this->getUIColor($palette->getC1()) . "\nlet color2 = " . $this->getUIColor($palette->getC2()) . "\nlet color3 = " . $this->getUIColor($palette->getC3()) . "\nlet color4 = " . $this->getUIColor($palette->getC4()) . "\nlet color5 = " . $this->getUIColor($palette->getC5());
            return $this->render('default/scheme.html.twig', [
                'id' => $id,
                'palette' => $palette,
                'username' => '@patconrey',
                'css' => $css,
                'sass' => $sass,
                'swift' => $swift,
                'views' => $views
            ]);
        }
        return $this->render('default/scheme.html.twig', [
            'id' => 'ERROR',
            'username' => 'ERROR'
        ]);
    }

    public function getUIColor($hex)
    {
        list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
        $uicolor = "UIColor(red:" . round($r/255, 2) . ", green:" . round($g/255, 2) . ", blue:" . round($b/255, 2) . ", alpha:1.0)";
        return $uicolor;
    }

    /**
     * @Route("/new_palette", name="post_palette")
     */
    public function recordPalette(Request $request)
    {
        /*
        We want the posted JSON to be
        {
            token: '',
            c_1: '',
            c_2: '',
            c_3: '',
            c_4: '',
            c_5: '',
            url: ''
        }
        */

        $entityManager = $this->getDoctrine()->getManager();

        $c1 = $request->get('c_1');
        $c2 = $request->get('c_2');
        $c3 = $request->get('c_3');
        $c4 = $request->get('c_4');
        $c5 = $request->get('c_5');
        $username = $request->get('username');
        $token = $request->get('token');
        $url = $request->get('url');
        $date = new DateTime();

        $palette = new ColorPalette();
        $palette->setC1($c1);
        $palette->setC2($c2);
        $palette->setC3($c3);
        $palette->setC4($c4);
        $palette->setC5($c5);
        $palette->setToken($token);
        $palette->setUrl($url);
        $palette->setUsername($username);
        $palette->setViews(0);
        $palette->setCreatedAt($date);

        $entityManager->persist($palette);
        $entityManager->flush();

        return $this->json(array('c1'=>$c1));
    }
}
