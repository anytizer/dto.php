<?php
namespace setups;

// SELECT CONCAT('public $', UPPER(role_name), ' = ', role_id, ';') roles FROM account_roles;
// SELECT CONCAT('public $', UPPER(REPLACE(role_name, ' ', '_')), ' = ', role_id, ';') roles FROM account_roles;

// roles are organization dependent; let organization create their own roles for their users
// eg, at school:
//     principal, teacher, laboratory, library, accounts, computers, examination
//     prospects, guardians, parents, students, bus driver, canteen
//     public relations,

class roles
{
    /**
     * @var bool
     */
    private $active;

/*
public $SUPER_ADMIN = 1;
public $ADMIN = 2;
public $ACCOUNTS = 3;
public $HUMAN_RESOURCE = 4;
public $FINANCE = 5;
public $MEMBER = 6;
public $VISITOR = 7;
public $ALL = 8;
 */

    public function __construct()
    {
    }

    public function SUPERADMIN(): roles
    {
        return $this;
    }

    public function ADMIN(): roles
    {
        return $this;
    }

    public function HUMANRESOURCE(): roles
    {
        return $this;
    }

    public function FINANCE(): roles
    {
        return $this;
    }

    public function ACCOUNTS(): roles
    {
        return $this;
    }

    public function STAFF(): roles
    {
        return $this;
    }

    public function MEMBER(): roles
    {
        return $this;
    }

    public function VISITOR(): roles
    {
        return $this;
    }

    public function ALL(): roles
    {
        // public
        // visitor
        // non-logged in user
        return $this;
    }
}