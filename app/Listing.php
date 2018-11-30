<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use Searchable;
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The relationships to always eager-load.
     *
     * @var array
     */
    protected $with = ['owner', 'uploads', 'amenities'];

    /**
     * A listing belongs to an owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A listing has many uploads.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }

    /**
     * A listing has many amenities.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'listing_to_amenity', 'listing_id', 'amenity_id');
    }

    /**
     * Get the indexable data array for the model. 
     * Basically decides what Algolia should use in fuzzy search
     */
    public function toSearchableArray()
    {
        $record = $this->toArray();

        $record['_geoloc'] = [
            'lat' => $record['lat'],
            'lng' => $record['lng'],
        ];

        $record['created_at_unix'] = $this->created_at->timestamp;
        $record['date_available_unix'] = strtotime($this->date_available);
        unset($record['updated_at'], $record['lat'], $record['lng']);

        return $record;
    }

}
