# Laravel Nova Exclusive Fields

This packages includes some ready-to-use Laravel Nova Exclusive fields. 

### What is a exclusive field?

An exclusive field is a special field that limits its value only on a database record. When you change this field for a record, exclusive field takes care to restore all other records to its default value. 

Imagine to have a `is_admin` boolean column on `users` table. Business requirements force you to have at most only a admin user. Changing value for a model, will reset all the other models' value.

### Fields type

- ExclusiveBoolean. It presents to user using a standard Laravel Nova Boolean field - In order to mantain data consistency you should set this field as not nullable.

- ExclusiveSelect. It presents to user using a standard Laravel Nova Select field - In order to mantain data consistency you should set this field as nullable.