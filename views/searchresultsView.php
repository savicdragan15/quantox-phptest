<div class='welcome_screen'>
    <a href='index.php'>Home page</a><br />
    <h2>Search results</h2>
    <?php
    if(isset($message))
    {
        echo $message;
    }
    else
    {
        $i=1;
        foreach ($results as $r)
        {
            echo "{$i}. Name: <span style='color:yellowgreen'>{$r->name}</span> || Email: <span style='color:yellowgreen'>{$r->email}</span><br/>";
            $i++;
        }
    }
    ?>
</div>
