<?php

namespace App\Services;

use App\Entities\Ad;

class AdService extends BaseService
{
    public function getRelevant(): Ad
    {
        $queryBuilder = $this->dbConn->createQueryBuilder();
        $query = $queryBuilder->select('ad')
        ->from(Ad::class, 'ad')
        ->where('ad.shows < ad.shows_limit')
        ->getQuery();
        $results = $query->getResult();

        $maxPriceAd = $results[0];

        foreach ($results as $result) {
            if ($result->getPrice() > $maxPriceAd->getPrice()) {
                $maxPriceAd = $result;
            }
        }

        return $maxPriceAd;
    }
}
