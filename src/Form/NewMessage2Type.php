<?php

namespace App\Form;

use App\Entity\Message;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewMessage2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('subject')
            ->add('body',TextareaType::class,[
                'label'=> 'Your answer',
            ])
            // ->add('sender',null,[
            //     'label'=> 'Send to',
            //     // 'multiple'=>true,
            //     // 'expanded' => true,
            // ])
            // ->add('sender',CollectionType::class,[
            //     'label'=> 'Send to',
            //     'entry_type'=>EntityType::class,
            //     'entry_options'=>[ //Options for CheckboxType goes here
            //         'attr' => ['class' => User::class],
            //     ]
            // ])
            // ->add('sender',ChoiceType::class,[
            //     'multiple'=>true,
            //     'expanded'=>true,
            //     'choices'=>[
            //         'label1'=>'value1',
            //         'label2'=>'value2'
            //     ]
            // ])
            // ->add('sender',EntityType::class,[
            //     'class' => User::class,
            //     // 'choice_label' => 'username',
            //     'multiple' => true,
            //     'expanded' => true,
            //     // 'choices' => $this->getUsers(),
            //     // 'choices' => $this->userRepository->findAll(),
            //     'label'=> 'Send to(Ctrl + left cleck--> multiple choices)'
            // ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
