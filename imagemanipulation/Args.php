<?php
namespace imagemanipulation
{

    class Args
    {
        public static function int($val, $name = 'Arg')
        {
            return new IntegerChecker($val, $name);
        }
        public static function bool($val, $name = 'Arg'){
            return new BooleanChecker($val, $name);
        }
    }

    abstract class ArgumentChecker
    {

        protected $val;
        private $name;

        public function __construct($val, $name)
        {
            if ($val !== null){
                $this->checkType($val);
            }
            $this->val = $val;
            $this->name = $name;
        }
        
        protected abstract function checkType($val);

        public function required()
        {
            if (null === $this->val) {
            	$this->throwException('is required');
            }
            
            return $this;
        }
        
        /**
         * Internal function to throw a new exception
         * 
         * @param string $msg The message to show; will be prepended with the name of the variable under check
         * 
         * @throws \InvalidArgumentException
         */
        protected function throwException($msg){
            throw new \InvalidArgumentException($this->name . ' ' . $msg);
        }
        
        /**
         * returns the value of the checker
         * 
         * @param \Closure a optional transformation closure. This will get the value as a parameter
         * 
         * @return mixed the optionally transformed value
         */
        public function value(\Closure $fn = null){
            if ($fn){
                return $fn($this->val);
            }
            return  $this->val;
        }
    }

    class IntegerChecker extends ArgumentChecker
    {
        protected function checkType($val){
            return is_int($val + 0); // implicit cast to int when needed
        }
        public function max($max){
            if ($this->val>$max){
                $this->throwException('must be smaller then ' . $max);
            }
            return $this;
        }
        public function min($min){
            if ($this->val<$min){
                $this->throwException('must be larger then ' . $min);
            }
            return $this;
        }
        
        public function value(\Closure $fn = null){
           return (int) parent::value($fn);
        }
    }
    
    class BooleanChecker extends ArgumentChecker{
        protected function checkType($val){
            return is_bool($val);
        }
        public function isTrue(){
            if ($this->val === false){
                $this->throwException('must be true');
            }
        }
        public function isFalse(){
            if ($this->val === true){
                $this->throwException('must be false');
            }
        }
        
        public function value(\Closure $fn = null){
            return !!parent::value($fn);
        }
    }
}