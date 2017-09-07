<?php
namespace Chainmail;

class ConcreteStage2 extends Stage{
    public function exec(ConcreteStage3 $stage, $raw)
    {
        return $raw .= "World ";
    }
}
