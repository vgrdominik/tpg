<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Twig\Extension;

use CTIC\Bridge\BitbagCMSPlugin\Entity\LandingInterface;

final class RenderLandingExtension extends \Twig_Extension
{
    /**
     * @return \Twig_SimpleFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('ctic_bridge_bitbag_render_landing', [$this, 'renderLanding'], ['needs_environment' => true, 'is_safe' => ['html']]),
        ];
    }

    /**
     * @param \Twig_Environment $twigEnvironment
     * @param LandingInterface $landing
     *
     * @return string
     *
     */
    public function renderLanding(\Twig_Environment $twigEnvironment, LandingInterface $landing): string
    {
        if (null !== $landing) {
            try{
                return $twigEnvironment->render('@CTICBridgeBitbagCMSPlugin/Landing/landing.html.twig', ['landing' => $landing]);
            }catch (\Exception $e)
            {
                return '';
            }
        }

        return '';
    }
}
