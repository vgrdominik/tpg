<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

interface FrequentlyAskedQuestionInterface
{
    /**
     * @return Landing
     */
    public function getLanding();

    /**
     * @param Landing $landing
     */
    public function setLanding(Landing $landing): void;
}
