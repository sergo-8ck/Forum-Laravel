<?php
//to database
function create($class, $attr = [], $times = null)
{
  return factory($class, $times)->create($attr);
}


//to Memory
function make($class, $attr = [], $times = null)
{
  return factory($class, $times)->make($attr);
}

?>