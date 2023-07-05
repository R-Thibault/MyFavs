<?php

namespace App\DataFixtures;

use App\Entity\Tags;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      $tags = [
        'PHP',
        'Symfony',
        'Doctrine',
        'Twig',
        'JavaScript',
        'React',
        'Node',
        'Express',
        'MongoDB',
        'MySQL',
        'PostgreSQL',
        'HTML',
        'CSS',
        'Bootstrap',
        'Tailwind',
        'SASS',
        'WordPress',
        'TypeScript',
        'Git',
        'GitHub',
        'GitLab',
        'Trello',
        'HTML5',
        'CSS3',
        'jQuery',
        'Tutorial',
        'API',
        'Next.js',
        'Bootstrap 5',
        'Tailwind CSS',
        'Font',
        'Icon',
        'Free Image',
        'Color',
        'package',
        'bundle',
        'outil',
        'library',
        'framework',
        'CMS',
        'education',
        'projet'  
      ];
  
      foreach ($tags as $tag) {
        $newTag = new Tags();
        $newTag->setTag($tag);
        $manager->persist($newTag);
    }
  
    $manager->flush();
  }
}
