<?php

function timeDifference($targetDateTime)
{
    $targetDate = new DateTime($targetDateTime);
    $now = new DateTime();
    $diff = $targetDate->diff($now);
    if ($diff->days > 0) {
        return $diff->days . " days";
    } elseif ($diff->h > 0) {
        return $diff->h . " hours";
    } elseif ($diff->i > 0) {
        return $diff->i . " minutes";
    } else {
        return $diff->s . " seconds";
    }
}

?>