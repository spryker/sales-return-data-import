<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Zed\SalesReturnDataImport\Business\ReturnDataImportStep;

use Orm\Zed\SalesReturn\Persistence\SpySalesReturnReasonQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\SalesReturnDataImport\Business\DataSet\ReturnReasonDataSetInterface;

class ReturnReasonWriterStep implements DataImportStepInterface
{
    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $salesReturnReasonEntity = $this->createSalesReturnReasonQuery()
            ->filterByKey($dataSet[ReturnReasonDataSetInterface::COLUMN_REASON_KEY])
            ->findOneOrCreate();

        $salesReturnReasonEntity
            ->setGlossaryKeyReason($dataSet[ReturnReasonDataSetInterface::COLUMN_GLOSSARY_KEY_REASON])
            ->save();
    }

    /**
     * @module SalesReturn
     *
     * @return \Orm\Zed\SalesReturn\Persistence\SpySalesReturnReasonQuery
     */
    protected function createSalesReturnReasonQuery(): SpySalesReturnReasonQuery
    {
        return SpySalesReturnReasonQuery::create();
    }
}