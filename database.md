# Database Standards

* All tables must have: is_active, is_approved, added_on, modified_on flag fields.
added_on field can often reflect business requirements like, created_on, created_at.

Primary key of the table is varchar(36) as UUID.
No auto_increment IDs please.

Naming conventions:
Flags should start using in_, is_.
