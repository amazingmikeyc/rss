<p><em><?=htmlentities($header->description); ?></em></p>

<?php
foreach ($items as $item) {    
?>
    <h2><a href='<?=htmlentities($item->link); ?>'><?=htmlentities($item->title); ?></a></h2>
    <blockquote><?=($item->description); ?></blockquote>

<?php    
}
?>