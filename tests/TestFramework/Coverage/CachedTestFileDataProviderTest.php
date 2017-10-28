<?php
/**
 * Copyright © 2017 Maks Rafalko
 *
 * License: https://opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace Infection\Tests\TestFramework\Coverage;

use Infection\TestFramework\Coverage\CachedTestFileDataProvider;
use Infection\TestFramework\Coverage\TestFileDataProvider;
use Mockery;

class CachedTestFileDataProviderTest extends Mockery\Adapter\Phpunit\MockeryTestCase
{
    public function test_the_second_call_returns_cached_result()
    {
        $class = 'Test\Class';
        $providerMock = Mockery::mock(TestFileDataProvider::class);
        $providerMock->shouldReceive('getTestFileInfo')
            ->with($class)
            ->once()
            ->andReturn(['data']);

        $infoProvider = new CachedTestFileDataProvider($providerMock);

        $info1 = $infoProvider->getTestFileInfo($class);
        $info2 = $infoProvider->getTestFileInfo($class);

        $this->assertSame($info1, $info2);
    }
}
