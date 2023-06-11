<?php

it('fixes the xml', function () {
    [$statusCode, $output] = run('default', [
        'path' => base_path('tests/Fixtures/fixers/file.xml'),
    ]);

    expect($statusCode)->toBe(1)
        ->and($output)
        ->toContain('FAIL')
        ->toContain('  ⨯')
        ->toContain(
            <<<'EOF'
                  -<?xml version="1.0" encoding="UTF-8"?>
                  
                  -<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="./vendor/phpunit/phpunit/phpunit.xsd"
                  
                  -   bootstrap="vendor/autoload.php"
                  
                  -         colors="true"
                  
                  ->
                  
                  -<testsuites><testsuite name="Feature">
                  
                  -<directory suffix="Test.php">./tests/Feature</directory>
                  
                  -</testsuite><testsuite name="Unit">
                  
                  -<directory suffix="Test.php">./tests/Unit</directory>
                  
                  -</testsuite></testsuites>
                  
                  -<source><include><directory suffix=".php">./app</directory>
                  
                  -</include></source>
                  
                  -</phpunit>
                  
                  +<?xml version="1.0" encoding="UTF-8"?>
                  +<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="./vendor/phpunit/phpunit/phpunit.xsd" bootstrap="vendor/autoload.php" colors="true">
                  +  <testsuites>
                  +    <testsuite name="Feature">
                  +      <directory suffix="Test.php">./tests/Feature</directory>
                  +    </testsuite>
                  +    <testsuite name="Unit">
                  +      <directory suffix="Test.php">./tests/Unit</directory>
                  +    </testsuite>
                  +  </testsuites>
                  +  <source>
                  +    <include>
                  +      <directory suffix=".php">./app</directory>
                  +    </include>
                  +  </source>
                  +</phpunit>
                EOF,
        );
});

it('fixes the xml.dist', function () {
    [$statusCode, $output] = run('default', [
        'path' => base_path('tests/Fixtures/fixers/file.xml.dist'),
    ]);

    expect($statusCode)->toBe(1)
        ->and($output)
        ->toContain('FAIL')
        ->toContain('  ⨯')
        ->toContain(
            <<<'EOF'
                  -<?xml version="1.0" encoding="UTF-8"?>
                  
                  -<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="./vendor/phpunit/phpunit/phpunit.xsd"
                  
                  -   bootstrap="vendor/autoload.php"
                  
                  -         colors="true"
                  
                  ->
                  
                  -<testsuites><testsuite name="Feature">
                  
                  -<directory suffix="Test.php">./tests/Feature</directory>
                  
                  -</testsuite><testsuite name="Unit">
                  
                  -<directory suffix="Test.php">./tests/Unit</directory>
                  
                  -</testsuite></testsuites>
                  
                  -<source><include><directory suffix=".php">./app</directory>
                  
                  -</include></source>
                  
                  -</phpunit>
                  
                  +<?xml version="1.0" encoding="UTF-8"?>
                  +<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="./vendor/phpunit/phpunit/phpunit.xsd" bootstrap="vendor/autoload.php" colors="true">
                  +  <testsuites>
                  +    <testsuite name="Feature">
                  +      <directory suffix="Test.php">./tests/Feature</directory>
                  +    </testsuite>
                  +    <testsuite name="Unit">
                  +      <directory suffix="Test.php">./tests/Unit</directory>
                  +    </testsuite>
                  +  </testsuites>
                  +  <source>
                  +    <include>
                  +      <directory suffix=".php">./app</directory>
                  +    </include>
                  +  </source>
                  +</phpunit>
                EOF,
        );
});
