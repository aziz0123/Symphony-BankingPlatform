<?php

namespace App\Controller;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\WriterInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Bonus;
use App\Entity\Pack;
use App\Form\PackType;
use App\Repository\PackRepository;
use ContainerV4E8b2Y\getPackRepositoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;
use Endroid\QrCode\Label\Font\NotoSans;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/pack')]
class PackController extends AbstractController
{


    #[Route('/QrCode/{id}', name: 'app_QrCode')]
    public function qrCode(ManagerRegistry $doctrine, $id)
    {
        return $this->render("front/GestionEvent/QR.html.twig", ['id' => $id]);
    }
/*public function index(PackRepository $packRepository ): Response
    {
        $packs = $packRepository->findBy([], ['placesPack' => 'DESC']);

        $totalPlaces = 0;
        foreach ($packs as $pack) {
            $totalPlaces += $pack->getPlacesPack();
        }

        $packsStats = [];
        $rank = 1;
        foreach ($packs as $pack) {
            $percentage = ($pack->getPlacesPack() / $totalPlaces) * 100;

            $packStats = new \stdClass();
            $packStats->pack = $pack;
            $packStats->rank = $rank;
            $packStats->percentage = round($percentage, 2);
            $packsStats[] = $packStats;

            $rank++;
        }

        return $this->render('pack/index.html.twig', [
            'packsStats' => $packsStats,
            'packs' => $packRepository->findAll(),
            'total' => $totalPlaces,
        ]);
    }*/
    #[Route('/QrCode', name: 'app_qr_codes')]
    public function qrGenerator(ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        $ref=("");
        $qrcode = QrCode::create( $ref)

            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        $writer = new PngWriter();
        return new Response($writer->write($qrcode)->getString(),
            Response::HTTP_OK,
            ['content-type' => 'image/png']
        );

    }

    #[Route('/pdf', name: 'app_pdf', methods: ['GET'])]
    public function pdf(PackRepository $packRepository){
        $packs = $packRepository->findAll();



        ////////PDF
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);
        $html = $this->renderView('default/pdf.html.twig', [
            'title' => "Welcome to our PDF Test",
             'packs'=>$packs
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $output = $dompdf->output();
        $publicDirectory =$this->getParameter('kernel.project_dir');
        $pdfFilepath = $publicDirectory . '/mypdf.pdf';
        file_put_contents($pdfFilepath, $output);

        return new Response("The PDF file has been succesfully generated !");
    }

    #[Route('/front', name: 'app_pack_front', methods: ['GET'])]
    public function front(Request $request,PaginatorInterface $paginator,PackRepository $packRepository,): Response
    {

        /**/
        $query = $packRepository->createQueryBuilder('p');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            1
        );


        return $this->render('pack/front.html.twig', [

            'packs' => $pagination,

        ]);

    }

    #[Route('/', name: 'app_pack_index', methods: ['GET'])]
    public function index(Request $request,PackRepository $packRepository): Response
    {
        $searchTerm = $request->query->get('searchTerm');
        $packs = [];

        if ($searchTerm) {
            $packs = $packRepository->findBy(['nom' => $searchTerm]);
        } else {
            $packs = $packRepository->findAll();
        }

        return $this->render('pack/index.html.twig',['packs'=>$packs,]);
    }


    #[Route('/new', name: 'app_pack_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PackRepository $packRepository): Response
    {
        $pack = new Pack();

        $form = $this->CreateForm(PackType::class, $pack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transport = (new Swift_SmtpTransport('smtp.gmail.com',25, 'tls'))
                ->setUsername('recycle.tunisia')
                ->setPassword('nnkuarrygzxlbspu');
            $mailer = new Swift_Mailer($transport);

            $message = (new Swift_Message('Pack ajouté avec succes'))
                ->setFrom(['recycle.tunisia@gmail.com' => 'Recycle Tunisia'])
                ->setTo('ayoub.hammoudi@esprit.tn')
                ->setBody('vous avez ajouter un nouveau cour !');

            $mailer->send($message);
            $packRepository->save($pack, true);
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
               // $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('kernel.project_dir'),
                        $newFilename
                    );
                } catch (\Exception $e) {

                }
                $pack->setImage($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pack);
            $entityManager->flush();

            return $this->redirectToRoute('app_pack_index', ['id' => $pack->getId()],Response::HTTP_SEE_OTHER);
        }

        return $this->render('pack/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_pack_show', methods: ['GET'])]
    public function show(Pack $pack): Response
    {
        return $this->render('pack/show.html.twig', [
            'pack' => $pack,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pack_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pack $pack, PackRepository $packRepository): Response
    {
        $form = $this->createForm(PackType::class, $pack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packRepository->save($pack, true);

            return $this->redirectToRoute('app_pack_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pack/edit.html.twig', [
            'pack' => $pack,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pack_delete', methods: ['POST'])]
    public function delete(Request $request, Pack $pack, PackRepository $packRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pack->getId(), $request->request->get('_token'))) {
            $packRepository->remove($pack, true);
        }

        return $this->redirectToRoute('app_pack_index', [], Response::HTTP_SEE_OTHER);
    }
}
