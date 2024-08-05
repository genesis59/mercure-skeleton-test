<?php

namespace App\DataFixtures;

use App\Entity\Friendship;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FriendshipFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 1; $i <= 5; $i++) {
            $friendship = new Friendship();
            /** @var User $user1 */
            $user1 = $this->getReference("user-$i");
            /** @var User $user2 */
            $user2 = $this->getReference("user-" . ($i + 5));
            $friendship->setRequester($user1);
            $friendship->setReceiver($user2);
            $manager->persist($friendship);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
