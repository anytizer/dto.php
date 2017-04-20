<?php
namespace business;
use setups\business_entity;
use setups\roles;
$entities[] = (new business_entity())
    ->business("Library", "Issue Books", "library_issuance")
    ->user((new roles())->ALL())
    ->methods(array(
        "issue(book)",
        "return book(book)",
    ));