<?php
if(isset($message))
{
    echo $message;
}
?>
<div class='welcome_screen'>
    <a href='index.php'>Home page</a><br />
    <h2>Log in</h2>
    <form name='searchFrm' action='index.php?c=quantox&f=login' method='POST'>
        <input type='text' name="email" placeholder='Type email here...' class='searchfor' /><br/><br />
        <input type='password' name="password" placeholder='Type password here...' class='searchfor' /><br/><br/>
        <input type="submit" name='loginBtn' value="LogIn" class="searchbtn"/>
    </form>
</div>

