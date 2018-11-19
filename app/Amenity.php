<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{

    /**
     * The relationships to always eager-load.
     *
     * @var array
     */
    protected $with = [];

    /**
     * An amenity belongs to many listings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function listings()
    {
        return $this->belongsToMany(Listing::class, 'listing_to_amenity', 'amenity_id', 'listing_id');
    }
}
