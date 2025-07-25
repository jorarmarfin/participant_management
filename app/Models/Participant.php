<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Participant extends Model
{
    use HasUuids;
    protected $table = 'participants';
    protected $guarded = [];

    protected function Names(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => mb_strtoupper($value),
        );
    }
    protected function lastName():Attribute
    {
        return Attribute::make(
            set: fn (string $value) => mb_strtoupper($value),
        );
    }
    protected function country():Attribute
    {
        return Attribute::make(
            set: fn (string $value) => mb_strtoupper($value),
        );
    }
    protected function phone():Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => (is_null($value)) ? null : str_replace(['(',')',' ','-'],'',$value),
        );
    }
    public function ubigeo(): HasOne
    {
        return $this->hasOne(Ubigeo::class, 'id', 'ubigeo_id');
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_participant')->withTimestamps()->withPivot('event_date');
    }




}
