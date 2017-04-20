<?php
namespace business;
use setups\business_entity;
use setups\roles;

# List of projects we completed
$entities[] = (new business_entity())
    ->business("Life Experiences", "projects", "project_projects")
    ->user((new roles())->ALL())
    ->user((new roles())->ADMIN())
    ->methods(array(
        "browse projects",
        "project details (project)",
        "add project (project)",
        "delete project (project)",
        "save link (project)",
        "disable (project)",
		"downloadable links",
		"donate project",
    ));