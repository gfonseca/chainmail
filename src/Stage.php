<?php
namespace Chainmail;

/**
* This class represents an item of whole process
* @author Georgio Barbosa <georgio.barbosa@gmail.com>
*/
abstract class Stage{

    /**
    * @var string $raw The data who joined in the process
    * @access private
    */
    private $raw;

    /**
    * @var \Chainmail\Stage $next_stage This stage is dependt of $next_stage
    * @access private
    */
    private $next_stage;

    public function __construct()
    {
        $this->next_stage = null;
        if(!self::is_end($this)) {
            $this->next_stage = self::get_depent_obj($this);
        }
    }

    /**
    * Start all process and iterate over all relationed stages
    * @return the proccessed raw
    */
    public function run($raw)
    {
        $this->raw = $raw;
        echo $raw."\n";
        if(self::is_end($this)) {
            $this->raw = $this->exec($this->raw);
        } else {
            $this->raw = $this->next_stage->run($this->raw);
        }

        return $this->raw;
    }

    private static function is_start($obj)
    {
        return  self::get_parent_class($obj) == \Chainmail\StartStage::class;
    }

    private static function is_end($obj)
    {
        return  self::get_parent_class($obj) == \Chainmail\EndStage::class;
    }

    private static function get_parent_class($obj)
    {
        return get_parent_class($obj);
    }

    private static function get_depent_obj($obj)
    {
        $child_class = get_class($obj);
        $reflection_class = new \ReflectionClass($child_class);
        $reflection_exec = $reflection_class->getMethod("exec");
        $reflection_depend_class = $reflection_exec->getParameters()[0];
        $class = $reflection_depend_class->getClass()->getName()    ;
        return new $class;
    }
}
