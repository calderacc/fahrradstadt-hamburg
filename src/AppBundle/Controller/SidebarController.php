<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Favorite;
use AppBundle\Entity\Photo;
use AppBundle\Model\CriticalmassModel;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class SidebarController extends AbstractController
{
    public function sidebarAction(Request $request, UserInterface $user = null, Photo $photo = null): Response
    {
        $commentList = $this->getDoctrine()->getRepository(Comment::class)->findLatest($this->getCity($request), 10);
        $favouriteList = $this->getDoctrine()->getRepository(Favorite::class)->findLatest($this->getCity($request), 10);
        $criticalmass = $this->getCriticalmass($request);

        return $this->render('AppBundle:Sidebar:sidebar.html.twig', [
            'commentList' => $commentList,
            'favouriteList' => $favouriteList,
            'criticalmass' => $criticalmass,
            'calendarEntryList' => $this->getCalendar(),
        ]);
    }

    protected function getCriticalmass(Request $request): ?CriticalmassModel
    {
        $city = $this->getCity($request);

        if (!$city->getCriticalmassCitySlug()) {
            return null;
        }

        $redisConnection = RedisAdapter::createConnection('redis://localhost');

        $cache = new RedisAdapter(
            $redisConnection,
            $namespace = '',
            $defaultLifetime = 0
        );

        $cacheItem = $cache->getItem(sprintf('criticalmass-%s', $city->getCriticalmassCitySlug()));

        return $cacheItem->get();
    }

    protected function getCalendar(): ?array
    {
        $redisConnection = RedisAdapter::createConnection('redis://localhost');

        $cache = new RedisAdapter(
            $redisConnection,
            $namespace = '',
            $defaultLifetime = 0
        );

        $cacheItem = $cache->getItem('calendar-entry-list');

        $entryList = $cacheItem->get();

        return $entryList;
    }
}
