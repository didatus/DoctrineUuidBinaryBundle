# Doctrine UUID Binary Bundle

There is a great extension for using UUIDs with Doctrine entities in Symfony projects:
[ramsey/uuid-doctrine](https://github.com/ramsey/uuid-doctrine)

The extension uses VARCHAR or BINARY to store the UUID in the database. For the UUID binary type the extension uses PHP to convert the UUID to binary. I wanted to use the MySQL function UUID_TO_BIN and BIN_TO_UUID to convert the UUID to binary. The MySQL functions have a flag to optimize the binary data for more efficient indexes.

So if you want to use UUIDs with Symfony Doctrine and want to optimize the performance to the last bit, then you can try this extension. The performance advantage differs from case to case.
