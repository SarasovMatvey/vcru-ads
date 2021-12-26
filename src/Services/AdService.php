<?php

namespace App\Services;

use App\Entities\Ad;
use Exception;

class AdService extends BaseService
{
  /**
   * Returns the ad that is most suitable for display
   * at the moment based on the algorithm.
   *
   * @return Ad
   *
   * @throws Exception
   */
    public function getRelevant(): Ad
    {
        $queryBuilder = $this->dbConn->createQueryBuilder();
        $query = $queryBuilder->select('ad')
        ->from(Ad::class, 'ad')
        ->where('ad.shows < ad.shows_limit')
        ->getQuery();
        $results = $query->getResult();

        if (count($results) === 0) {
            throw new Exception('No ads to show');
        }

        $maxPriceAd = $results[0];

        foreach ($results as $result) {
            if ($result->getPrice() > $maxPriceAd->getPrice()) {
                $maxPriceAd = $result;
            }
        }

        return $maxPriceAd;
    }
}
