<?php

namespace App\DataFixtures;

use App\Entity\Conversation;
use App\Entity\Message;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MessageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 1; $i <= 5; $i++) {
            /** @var User $user */
            $user = $this->getReference("user-$i");
            /** @var Conversation $conversation */
            $conversation = $this->getReference("conversation-$i");
            $message = new Message();
            $message->setSentBy($user);
            $message->setConversation($conversation);
            $message->setSendAt(new \DateTime());
            $message->setRead(true);
            $message->setContent('Hello user' . ($i + 5) . ', this is user' . $i);
            $manager->persist($message);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            ConversationFixtures::class
        ];
    }
}
