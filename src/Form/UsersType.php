<?php
    namespace App\Form;

    use App\Entity\Users;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    class UsersType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
            ->add('firstname', TextType::class, [
                'attr' => ['id' => 'firstname']
            ])
            ->add('lastname', TextType::class, [
                'attr' => ['id' => 'lastname']
            ])
            ->add('cin', TextType::class, [
                'attr' => ['id' => 'cin']
            ])
            ->add('address', TextType::class, [
                'attr' => ['id' => 'address']
            ])
            ->add('clubid', TextType::class, [
                'attr' => ['id' => 'clubid']
            ]);
        }
    
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'data_class' => Users::class,
            ]);
        }
    }
?>    