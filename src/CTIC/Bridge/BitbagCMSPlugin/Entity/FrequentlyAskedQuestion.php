<?php

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use BitBag\SyliusCmsPlugin\Entity\FrequentlyAskedQuestion as BaseFrequentlyAskedQuestion;

class FrequentlyAskedQuestion extends BaseFrequentlyAskedQuestion implements FrequentlyAskedQuestionInterface
{
    /**
     * @var Landing
     */
    protected $landing;

    /**
     * @return Landing
     */
    public function getLanding()
    {
        return $this->landing;
    }

    /**
     * @param Landing $landing
     */
    public function setLanding(Landing $landing): void
    {
        $this->landing = $landing;
    }
}