<?php
namespace Chainmail;

class ConcreteStage extends StartStage{
    public function exec(ConcreteStage2 $stage, $raw)
    {
        return $raw .= "Hello";
    }
}
