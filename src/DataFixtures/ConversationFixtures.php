<?php

namespace App\DataFixtures;

use App\Entity\Conversation;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ConversationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 1; $i <= 5; $i++) {
            /** @var User $user1 */
            $user1 = $this->getReference("user-$i");
            /** @var User $user2 */
            $user2 = $this->getReference("user-" . ($i + 5));
            $conversation = new Conversation();
            $conversation->setTitle("Conversation $i");
            $conversation->setCreatedBy($user1);
            $conversation->addParticipant($user1);
            $conversation->addParticipant($user2);
            $manager->persist($conversation);
            $this->addReference("conversation-$i", $conversation);
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
