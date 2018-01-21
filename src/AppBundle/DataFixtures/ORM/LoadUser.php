<?php 


namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
* @author Darius Clinton Tsafack <clintontsafack@gmail.com>
*/
class LoadUser extends Fixture implements ContainerAwareInterface
{
	protected $container;

	public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


	public function load(ObjectManager $manager)
	{
		
	}
}