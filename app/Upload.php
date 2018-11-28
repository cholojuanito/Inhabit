<?php

namespace App;

use App\Listing;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{

    /**
     * The attributes that can be mass assigned
     */
    protected $fillable = ['filename', 'mime', 'path', 'size'];

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
    protected $hidden = ['id', 'created_at', 'updated_at'];

    /**
     * The relationships to always eager-load.
     *
     * @var array
     */
    protected $with = [];

    /**
     * A an upload belongs to a listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }
}
