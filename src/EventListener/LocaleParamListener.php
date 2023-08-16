<?php

declare(strict_types=1);

namespace App\EventListener;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\RouterInterface;

class LocaleParamListener implements EventSubscriberInterface
{
    private RouterInterface $router;
    private string $defaultLocale;
    private array $additionalLocales;
    private string $localeRouteParam;

    public function __construct(RouterInterface $router, $defaultLocale = 'ru', string $additionalLocales = '', $localeRouteParam = 'locale')
    {
        $this->router = $router;
        $this->defaultLocale = $defaultLocale;
        $this->additionalLocales = explode('|', $additionalLocales);
        $this->localeRouteParam = $localeRouteParam;
    }

    public function isLocaleSupported($locale): bool
    {
        return in_array($locale, $this->additionalLocales);
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $locale = $request->get($this->localeRouteParam);

        if (null !== $locale ) {
            $request->setLocale($locale);
        }
    }

    #[ArrayShape([KernelEvents::REQUEST => "array[]"])]
    public static function getSubscribedEvents(): array
    {
        return array(
            KernelEvents::REQUEST => [['onKernelRequest', 17]],
        );
    }
}