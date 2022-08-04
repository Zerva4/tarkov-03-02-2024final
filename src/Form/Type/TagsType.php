<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Tag;
use App\Interfaces\TagRepositoryInterface;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TagsType extends AbstractType implements DataTransformerInterface
{
    private TagRepositoryInterface $tags;

    public function __construct(TagRepositoryInterface $tags)
    {
        $this->tags = $tags;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'entity_manager' => null,
            'required' => false,
            'label' => 'Tags',
            'attr' => [
                'placeholder' => 'разделить теги запятыми',
                'data-ajax' => '/tags.json',
            ],
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addModelTransformer(new CollectionToArrayTransformer(), true)
            ->addModelTransformer($this, true);
    }

//    public function buildView(FormView $view, FormInterface $form, array $options): void
//    {
//        $view->vars['tags'] = $this->tags->findAll();
//    }

    public function getParent(): ?string
    {
        return TextType::class;
    }

    public function transform(mixed $value)
    {
        return implode(', ', $value);
    }

    public function reverseTransform(mixed $value)
    {
        $tags = [];

        if (null !== $value) {
            $names = array_unique(array_filter(array_map('trim', explode(',', $value))));

            $tags = $this->tags->findBy([
                'name' => $names
            ]);

            $newNames = array_diff($names, $tags);

            foreach ($newNames as $name) {
                $tag = new Tag();
                $tag->setName($name);
                $tags[] = $tag;
            }
        }

        return $tags;
    }
}
