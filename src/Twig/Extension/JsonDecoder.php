<?php
namespace App\Twig\Extension;
/*

use Symfony\Component\Serializer\Encoder\JsonDecode;
use Twig\Extension\AbstractExtension;
use Twig\Extension\
class JsonDecoder extends AbstractExtension
{
    public function getName()
    {
        return 'twig.json_decode';
    }

    public function getFilters()
    {
        return array(
            'json_decode'   => new \Twig_SimpleFilter($this->getName(), 'jsonDecode')
        );
    }

    public function jsonDecode($string)
    {
        return json_decode($string);
    }
}*/

use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Extension\AbstractExtension;
use Doctrine\Common\Collections\Collection;
use Twig\TwigFilter;

/*class JsonDecoder extends AbstractExtension
{
    public function getFilters(): array
    {
        return array(
            new TwigFilter('filterType', array($this, 'filterType')),
        );
    }

    public function filterType(array $roles): array
    {
        $roles == "ROLE_STUD,ROLE_USER";
       return $user->filter(function ($u) use ($roles) {
            return $u->getRoles() == $roles; // Replace this by your own check.
        });
        return $roles;
    }

    public function getName(): string
    {
        return 'your_twig_filters';
   }
}*/
class JsonDecoder extends AbstractExtension
{

    public function getFilters(): array
    {
        return array(
            new TwigFilter('json_decode', [$this, 'Stud']),
        );
    }

    public function Stud( array $roles)
    {
        $roles[] = "ROLE_STUD,ROLE_USER";
        return json_decode($roles);
    }

//    public function getName(): string
//    {
//        return 'your_twig_filters';
//    }
}