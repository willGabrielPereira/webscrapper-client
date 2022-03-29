<?php

namespace model;

class History extends ModelBase
{
    protected $fillable = [
        'id',
        'date',
        'status',
        'reason',
        'bidding_id'
    ];

    public function setDate($date)
    {
        $this->attributes['date'] = date('Y-m-d H:i:s', (int)$date);
    }
}
