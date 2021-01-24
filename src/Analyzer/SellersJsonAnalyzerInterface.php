<?php

declare(strict_types=1);

namespace App\Analyzer;
use App\Entity\AnalysisResult;

/**
 * SellersJsonAnalyzerInterface.
 */
interface SellersJsonAnalyzerInterface
{
    /**
     * Analyze and store data on sellers.json
     */
    public function analyze(string $associativeSellersJson): AnalysisResult;
}