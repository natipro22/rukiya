<?php

namespace App\Libraries\Report;

/**
 *
 * @author Mohammed
 */
interface IReport {
    public function downloadReport(string $filename);
}
