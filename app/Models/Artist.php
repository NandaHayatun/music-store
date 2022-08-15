<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    protected $primaryKey = 'ArtistID';
    protected $fillable = ['ArtistName','PackageName','ImageURL','ReleaseDate','Price','SampleURL'];
}
