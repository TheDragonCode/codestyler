<?php

it('fixes the code', function () {
    [$statusCode, $output] = run('default', [
        'path' => base_path('tests/Fixtures/fixers/file.yml'),
    ]);

    expect($statusCode)->toBe(1)
        ->and($output)
        ->toContain('FAIL')
        ->toContain('  ⨯')
        ->toContain(
            <<<'EOF'
                   author: 'Andrey Helldar'
                  -
                   inputs:
                  -        github_token:
                  -          description: 'GitHub token or PAT token.'
                  -          required: false
                  -          default: ${{ github.token }}
                  -
                  -
                  +    github_token:
                  +        description: 'GitHub token or PAT token.'
                  +        required: false
                  +        default: '${{ github.token }}'
                   runs:
                       using: docker
                       image: Dockerfile
                       args:
                  -            -   ${{ inputs.github_token }}
                  -            -   ${{ inputs.fix }}
                  +        - '${{ inputs.github_token }}'
                  +        - '${{ inputs.fix }}'
                  +branding:
                  +    icon: check
                  +    color: purple
                   
                  -branding:
                  -        icon: check
                  -        color: purple
                EOF,
        );
});
