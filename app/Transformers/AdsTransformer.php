<?php

namespace App\Transformers;

use App\Model\Advertise;
use League\Fractal\TransformerAbstract;

class AdsTransformer extends TransformerAbstract
{
    /**
     * Transform a post.
     *
     * @param Advertise $advertise
     * @return array
     */
    public function transform(Advertise $advertise): array
    {
        return [
            'id' => $advertise->id,
            'title' => $advertise->provider_name,
            'slug' => $advertise->slug,
	        'price' => $advertise->price,
	        'status' => $advertise->status
        ];
    }
}
