<?xml version="1.0" encoding="utf-8"?>
<phpunit bootstrap="bootstrap.php" backupGlobals="false" colors="true">
    <testsuites>
		<testsuite name="Direct Access">
            <directory suffix="Test.php">tests/</directory>
        </testsuite>
		<testsuite name="API Access">
            <directory suffix="Test.php">api/</directory>
        </testsuite>
    </testsuites>
    <logging>
		<log type="testdox-text" target="logs/testdox-complete.txt" logIncompleteSkipped="true"/>
		<log type="testdox-text" target="logs/testdox.txt" logIncompleteSkipped="false"/>
    </logging>
</phpunit>
