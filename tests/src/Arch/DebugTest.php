<?php

declare(strict_types=1);

arch('Do not forget dumps in your production code')
    ->expect(['trap', 'dd', 'dump', 'exit', 'die', 'print_r', 'var_dump', 'echo', 'print'])
    ->not
    ->toBeUsed();
