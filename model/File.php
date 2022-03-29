<?php

namespace model;

class File extends ModelBase
{
    protected $fillable = [
        'id',
        'url',
        'date',
        'size',
        'name',
        'bidding_id'
    ];

    public function setDate($date)
    {
        $this->attributes['date'] = date('Y-m-d H:i:s', $date / 1000);
    }
}
