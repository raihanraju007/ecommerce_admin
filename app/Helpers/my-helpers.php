<?php

function imageUpload($image,$directory)
{
    $type         = $image->getClientOriginalExtension();
    $imageName    = time().'.'.$type ;
    $image->move( $directory, $imageName);
    return $directory.$imageName;
}
