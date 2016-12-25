<?php
/**
 * This file is part of the prooph/pdo-event-store.
 * (c) 2016-2016 prooph software GmbH <contact@prooph.de>
 * (c) 2016-2016 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ProophTest\EventStore\Projection;

use Prooph\Common\Messaging\FQCNMessageFactory;
use Prooph\Common\Messaging\NoOpMessageConverter;
use Prooph\EventStore\PDO\MySQLEventStore;
use Prooph\EventStore\PDO\PersistenceStrategy\MySQLSimpleStreamStrategy;
use ProophTest\EventStore\PDO\Projection\PDOEventStoreQueryTestCase;
use ProophTest\EventStore\PDO\TestUtil;

/**
 * @group pdo_mysql
 */
class MySQLEventStoreQueryTest extends PDOEventStoreQueryTestCase
{
    protected function setUp(): void
    {
        if (TestUtil::getDatabaseVendor() !== 'pdo_mysql') {
            throw new \RuntimeException('Invalid database vendor');
        }

        $this->connection = TestUtil::getConnection();
        TestUtil::initDefaultDatabaseTables($this->connection);

        $this->eventStore = new MySQLEventStore(
            new FQCNMessageFactory(),
            new NoOpMessageConverter(),
            TestUtil::getConnection(),
            new MySQLSimpleStreamStrategy()
        );
    }
}
