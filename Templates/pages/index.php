
<h2>Here are your RSS files</h2>

<ul>    
<?php foreach ($feeds as $feed) {
    ?><li><a href="/view/<?=$feed['id'];?>"><?=$feed['uri']; ?></a>
        <form action='/remove' method='post'><input type='hidden' name='id' value='<?=$feed['id'];?>'/><input type='submit' value='delete' /></form></li><?php
} 
?>
    <li><form action='/add' method='post'><input name='url' type='url' placeholder="add a new one..." /><input type='submit' value='add' /></form>
</ul>
