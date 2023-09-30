<?php

declare(strict_types=1);

namespace App\EventListener;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RouterInterface;

class LocaleParamListener implements EventSubscriberInterface
{
    private RouterInterface $router;
    private string $defaultLocale;
    private array $supportedLocales;
    private string $localeRouteParam;
    private RouteCollection $routeCollection;
    private UrlMatcherInterface $matcher;

    public function __construct(RouterInterface $router, $defaultLocale = '%app.default_locale%', string $supportedLocales = '%app.locales%', $localeRouteParam = '_locale')
    {
        $this->router = $router;
        $this->routeCollection = $router->getRouteCollection();
        $this->defaultLocale = $defaultLocale;
        $this->supportedLocales = explode('|', $supportedLocales);
        $this->localeRouteParam = $localeRouteParam;
        $context = new RequestContext("/");
        $this->matcher = new UrlMatcher($this->routeCollection, $context);
    }

    public function isLocaleSupported($locale): bool
    {
        return array_key_exists($locale, $this->supportedLocales);
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $baseUrl = $request->getBaseUrl();
        $pathInfo = $request->getPathInfo();
        $locale = $request->getPreferredLanguage();

        if ($this->isLocaleSupported($locale)) {
            $locale = $this->supportedLocales[$locale];
        } elseif (!$locale) {
            $locale = $request->getDefaultLocale();
        }

        $pathLocale = "/".$locale.$pathInfo;

        try {
            $this->matcher->match($pathLocale);
            $event->setResponse(
                new RedirectResponse($baseUrl.$pathLocale)
            );
        } catch (ResourceNotFoundException|MethodNotAllowedException $e) {
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