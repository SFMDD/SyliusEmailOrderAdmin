<?php

declare(strict_types=1);

namespace FMDD\SyliusEmailOrderAdminPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class FMDDSyliusEmailOrderAdminPlugin extends Bundle
{
    use SyliusPluginTrait;
}
