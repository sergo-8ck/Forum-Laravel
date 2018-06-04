<?php
//to database
function create($class, $attr = [])
{
  return factory($class)->create($attr);
}


//to Memory
function make($class, $attr = [])
{
  return factory($class)->make($attr);
}

?>