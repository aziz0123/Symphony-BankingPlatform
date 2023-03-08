<?php

namespace App\Controller;


use App\Entity\Account;
use App\Entity\Transaction;
use App\Entity\Type;
use App\Form\TransactionType;
use App\Form\TypeType;
use App\Repository\AccountRepository;
use App\Repository\CompteRepository;
use App\Repository\TransactionRepository;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Knp\Component\Pager\PaginatorInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;
use Symfony\UX\Chartjs\Model\Chart;




class TransactionController extends AbstractController
{
    private $logger;



    /**
     * @Route("/Acc", name="Acc")
     */
    public function AddTransaction(Request $request, CompteRepository $accountRepository): Response
    {


        $transaction = new Transaction();
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // object
            $sourceAccount = $transaction->getSourceAccount();
            //float
            $destinationAccount = $transaction->getDestinationAccount();
            //integer
            $RIBdonnee = $destinationAccount;
            $found = $accountRepository->findBy(array('rib' => $RIBdonnee), array('rib' => 'ASC'), 1, 0);

            //if rib exists
            if (count($found) != 0) {
                $r = $found[0];
                $sourceBalance = $sourceAccount->getBalance();
                $destinationBalance = $r->getBalance();
                $amount = $transaction->getAmount();

                //if solde suffisant pour transferer
                if ($sourceBalance > $amount) {
                    $sourceAccount->setBalance($sourceBalance - $amount);
                    $r->setBalance($destinationBalance + $amount);
                    $transaction->setCreatedAt(new \DateTime());
                    $transaction->setDestinationAccount($r->getRib());
                    $em->persist($transaction);

                    $em->flush();
                    return $this->redirectToRoute('ShowAccount');
                } else {
                    throw new \Exception('Insufficient funds');
                }
            } else {
                return $this->redirectToRoute('Acc', ['msg' => 'le rib saisi nest pas valide']);
                //throw new \Exception('rib');
            }
        } else
            return $this->render('Transaction/transaction.html.twig', [
                'form' => $form->createView()
            ]);
    }
    /**
     * @Route("/displayTransaction", name="displayTransaction")
     */
    public function displayTransaction(PaginatorInterface $paginator, Request $request): Response
    {
        $Transaction = $this->getDoctrine()->getManager()->getRepository(Transaction::class)->findAll();
        $Transaction = $paginator->paginate(
            $Transaction,
            $request->query->getInt('page', 1),
            3
        );
        return $this->render('transaction/show.html.twig', [
            'trans' => $Transaction
        ]);
    }
    /**
     * @Route("/pdfTransaction", name="pdfTransaction",methods="GET")
     */
    public function pdf(TransactionRepository $repository)
    {

        $pdfOptions =new Options();
        $pdfOptions->set('defaultFront','Arial');
        $dompdf = new Dompdf($pdfOptions);
        $Transaction =$repository->findAll();
        $html= $this->renderView('transaction/pdfTransaction.html.twig',
            ['trans'=> $Transaction]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();
        $dompdf->stream("Liste_des_Transaction.pdf",[
            "Attachment"=> true
        ]);
    }
    #[Route('/stats', name:'stats')]
public function statistique(TransactionRepository $depotRepo):Response{
    // on va chercher toutes les dossier 
    $transaction = $depotRepo->findAll();
    $range1=$depotRepo->countByAmountRange();
    $range2=$depotRepo->countByAmountRange2();
    $range3=$depotRepo->countByAmountRange3();
    
//get number from array approuved
    $approuved1 = $range1[0][1];
    $refused1 = $range2[0][1];
    $enattente1 = $range3[0][1];
    $total1 = $range1 + $range2 + $range3;
    
 
    return $this->render('Transaction/stat.html.twig', [
        'depCount1' => $approuved1,
        'depCount2' => $refused1,
        'depCount3' => $enattente1,
    ]);
}
   
}
