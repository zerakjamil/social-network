<?php

class Protection
{
    public function stripTags($data)
    {
        $allowed_tags = array('<br>','<b>','<i>','<strong>','<small>','<strong>','<caption>','<em>','<h1>','<h2>','<h3>','<h4>','<h5>','<h6>','<li>','<ul>','<ol>','<mark>','<p>','<pre>');
        return strip_tags($data,$allowed_tags);
    }

    public function stripSlashes($data)
    {
        return stripslashes($data);
    }

    public function filterInput($data)
    {
        return filterInputValue($data);
    }

    public function passwordHash($password)
    {
        return md5($password);
    }
}