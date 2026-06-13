<?php

$name = "Raju";
    // heredoc
    echo <<<HERE_DOC

        $name is a good boy.
        <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores ipsa odio illo quo aliquid quam harum ratione, necessitatibus cum nihil nobis quia consequuntur sequi accusamus minima exercitationem vel quas eaque!</p>
    
    HERE_DOC;
    
    echo("<br>");
    
    // nowdoc
    echo <<<'HERE_DOC'

        $name is a good boy.
        <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores ipsa odio illo quo aliquid quam harum ratione, necessitatibus cum nihil nobis quia consequuntur sequi accusamus minima exercitationem vel quas eaque!</p>
    
    HERE_DOC;

?>