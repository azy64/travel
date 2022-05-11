<?php

namespace App\Form;

use App\Entity\Etape;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\TransportRepository;

class EtapeType extends AbstractType
{
    public function __construct(TransportRepository $transportRepository)
    {
        $this->transportRepository = $transportRepository;
    }
    public function buildData(): array{
        $transports = $this->transportRepository->findAll();
        $transportArray = [];
        foreach ($transports as $transport) {
            $transportArray[$transport->getNumber()] = $transport;
        }
        return $transportArray;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('depart')
            ->add('arrival')
            ->add('depart_date')
            ->add('arrival_date')
            ->add('seat')
            ->add('gate')
            //->add('voyage')
            ->add('transport', ChoiceType::class, [ 'choices' => $this->buildData()])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etape::class,
        ]);
    }
}
