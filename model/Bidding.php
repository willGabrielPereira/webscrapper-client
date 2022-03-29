<?php

namespace model;

class Bidding extends ModelBase
{
    protected $fillable = [
        'id',
        'title',
        'url',
        'status',
        'description',
        'date',
    ];

    public function files()
    {
        return (new File($this->app))->db()->where('bidding_id', $this->id)->get();
    }

    public function histories()
    {
        return (new History($this->app))->db()->where('bidding_id', $this->id)->get();
    }

    public function setDate($date)
    {
        $this->attributes['date'] = date('Y-m-d H:i:s', $date / 1000);
    }
}
