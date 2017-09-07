<?php
namespace Chainmail;

class ConcreteStage3 extends EndStage{
    public function exec($raw)
    {
        return $raw .= "!";
    }
}
